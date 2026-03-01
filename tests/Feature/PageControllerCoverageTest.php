<?php

use App\Models\HomeBlock;
use App\Models\Post;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

it('renders home with stored settings and ordered blocks', function (): void {
    SiteSetting::set('home_hero_title', 'Custom Hero');
    SiteSetting::set('home_hero_description', 'Custom description');
    SiteSetting::set('hero_image', 'hero/banner.png');

    HomeBlock::query()->create(['title' => 'Third', 'description' => 'Block C', 'sort_order' => 3]);
    HomeBlock::query()->create(['title' => 'First', 'description' => 'Block A', 'sort_order' => 1]);
    HomeBlock::query()->create(['title' => 'Second', 'description' => 'Block B', 'sort_order' => 2]);

    $this->get(route('home'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Home')
            ->where('heroTitle', 'Custom Hero')
            ->where('heroDescription', 'Custom description')
            ->where('heroImage', asset('storage/hero/banner.png'))
            ->has('homeBlocks', 3)
            ->where('homeBlocks.0.title', 'First')
            ->where('homeBlocks.1.title', 'Second')
            ->where('homeBlocks.2.title', 'Third')
        );
});

it('renders about, services, and privacy pages from settings', function (): void {
    SiteSetting::set('about_content', 'About custom copy');
    SiteSetting::set('services_intro', 'Services custom intro');
    SiteSetting::set('privacy_content', 'Privacy custom copy');

    Service::query()->create(['title' => 'Service B', 'description' => 'Second', 'sort_order' => 2]);
    Service::query()->create(['title' => 'Service A', 'description' => 'First', 'sort_order' => 1]);

    $this->get(route('about'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('About')
            ->where('aboutContent', 'About custom copy')
        );

    $this->get(route('services'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Services')
            ->where('servicesIntro', 'Services custom intro')
            ->has('services', 2)
            ->where('services.0.title', 'Service A')
            ->where('services.1.title', 'Service B')
        );

    $this->get(route('privacy'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Privacy')
            ->where('privacyContent', 'Privacy custom copy')
        );
});

it('returns 404 for blog index when there are no published posts', function (): void {
    $this->get(route('blog'))->assertNotFound();
});

it('renders blog index with only published posts in date order', function (): void {
    Post::query()->create([
        'title' => 'Newest Published',
        'content' => '<p>Newest body</p>',
        'published_at' => now()->subHour(),
    ]);

    Post::query()->create([
        'title' => 'Old Published',
        'content' => '<p>Old body</p>',
        'published_at' => now()->subDays(2),
    ]);

    Post::query()->create([
        'title' => 'Draft Post',
        'content' => '<p>Draft body</p>',
        'published_at' => now()->addDay(),
    ]);

    $this->get(route('blog'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Blog/Index')
            ->has('posts', 2)
            ->where('posts.0.title', 'Newest Published')
            ->where('posts.1.title', 'Old Published')
        );
});

it('renders blog post details and returns 404 when slug is missing', function (): void {
    $post = Post::query()->create([
        'title' => 'Published Post',
        'content' => '<p>Body text</p>',
        'meta_title' => 'Meta title',
        'meta_description' => 'Meta description',
        'og_image' => 'og/posts/post.png',
        'published_at' => now()->subDay(),
    ]);

    $this->get(route('blog.show', ['slug' => $post->slug]))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Blog/Show')
            ->where('post.title', 'Published Post')
            ->where('post.slug', $post->slug)
            ->where('post.og_image_url', asset('storage/og/posts/post.png'))
            ->where('post.meta_title', 'Meta title')
            ->where('post.meta_description', 'Meta description')
            ->where('post.canonical_url', route('blog.show', ['slug' => $post->slug]))
        );

    $this->get(route('blog.show', ['slug' => 'missing-slug']))->assertNotFound();
});
