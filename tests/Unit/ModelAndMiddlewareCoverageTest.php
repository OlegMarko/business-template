<?php

use App\Http\Middleware\SetAdminLocale;
use App\Models\ContactRequest;
use App\Models\HomeBlock;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Filament\Panel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('maps contact request subject labels including fallback', function (): void {
    expect((new ContactRequest(['subject' => 'general']))->subject_label)->toBe('General enquiry');
    expect((new ContactRequest(['subject' => 'services']))->subject_label)->toBe('Services');
    expect((new ContactRequest(['subject' => 'partnership']))->subject_label)->toBe('Partnership');
    expect((new ContactRequest(['subject' => 'other']))->subject_label)->toBe('Other');
    expect((new ContactRequest(['subject' => 'custom']))->subject_label)->toBe('custom');
});

it('auto-generates post slug and filters published scope', function (): void {
    $published = Post::query()->create([
        'title' => 'A Published Post',
        'content' => 'Published content',
        'published_at' => now()->subMinute(),
    ]);

    $draft = Post::query()->create([
        'title' => 'Future Draft',
        'content' => 'Draft content',
        'published_at' => now()->addMinute(),
    ]);

    expect($published->slug)->toBe('a-published-post');
    expect($draft->slug)->toBe('future-draft');

    $publishedIds = Post::query()->published()->pluck('id')->all();
    expect($publishedIds)->toContain($published->id)->not->toContain($draft->id);
});

it('orders service and home block scopes by sort order then id', function (): void {
    $serviceSecond = Service::query()->create(['title' => 'S2', 'description' => 'Second', 'sort_order' => 2]);
    $serviceFirst = Service::query()->create(['title' => 'S1', 'description' => 'First', 'sort_order' => 1]);
    $serviceThird = Service::query()->create(['title' => 'S3', 'description' => 'Third', 'sort_order' => 2]);

    $orderedServices = Service::query()->ordered()->pluck('id')->all();
    expect($orderedServices)->toBe([$serviceFirst->id, $serviceSecond->id, $serviceThird->id]);

    $blockSecond = HomeBlock::query()->create(['title' => 'B2', 'description' => 'Second', 'sort_order' => 2]);
    $blockFirst = HomeBlock::query()->create(['title' => 'B1', 'description' => 'First', 'sort_order' => 1]);
    $blockThird = HomeBlock::query()->create(['title' => 'B3', 'description' => 'Third', 'sort_order' => 2]);

    $orderedBlocks = HomeBlock::query()->ordered()->pluck('id')->all();
    expect($orderedBlocks)->toBe([$blockFirst->id, $blockSecond->id, $blockThird->id]);
});

it('allows only admin users into the filament panel', function (): void {
    $panel = mock(Panel::class);

    $admin = User::factory()->make(['is_admin' => true]);
    $nonAdmin = User::factory()->make(['is_admin' => false]);

    expect($admin->canAccessPanel($panel))->toBeTrue();
    expect($nonAdmin->canAccessPanel($panel))->toBeFalse();
});

it('forces english locale in admin middleware', function (): void {
    app()->setLocale('de');

    $middleware = new SetAdminLocale();
    $response = $middleware->handle(Request::create('/admin'), fn () => new Response('ok'));

    expect(app()->getLocale())->toBe('en');
    expect($response->getContent())->toBe('ok');
});
