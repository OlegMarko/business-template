<?php

namespace App\Http\Controllers;

use App\Mail\ContactRequestConfirmation;
use App\Mail\ContactRequestNotification;
use App\Models\ContactRequest;
use App\Models\HomeBlock;
use App\Models\Post;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class PageController extends Controller
{
    public function home(): Response
    {
        $heroTitle = Schema::hasTable('site_settings')
            ? SiteSetting::get('home_hero_title', 'Professional services for businesses across Europe')
            : 'Professional services for businesses across Europe';
        $heroDescription = Schema::hasTable('site_settings')
            ? SiteSetting::get('home_hero_description', 'We help companies grow with tailored solutions, local expertise, and a commitment to quality and compliance across the EU.')
            : 'We help companies grow with tailored solutions, local expertise, and a commitment to quality and compliance across the EU.';
        $homeBlocks = Schema::hasTable('home_blocks')
            ? HomeBlock::ordered()->get()->toArray()
            : [
                ['title' => 'EU-wide coverage', 'description' => 'We operate across the European Union with local knowledge and regulatory awareness.'],
                ['title' => 'Compliant & secure', 'description' => 'Our processes align with GDPR and EU standards so you can focus on your business.'],
                ['title' => 'Results-driven', 'description' => 'We deliver measurable outcomes and clear communication at every step.'],
            ];

        $heroImage = null;
        if (Schema::hasTable('site_settings')) {
            $path = SiteSetting::get('hero_image', '');
            $heroImage = $path !== '' ? asset('storage/' . $path) : null;
        }

        return Inertia::render('Home', [
            'heroTitle' => $heroTitle,
            'heroDescription' => $heroDescription,
            'heroImage' => $heroImage,
            'homeBlocks' => $homeBlocks,
        ]);
    }

    public function about(): Response
    {
        $aboutContent = Schema::hasTable('site_settings')
            ? SiteSetting::get('about_content', '')
            : '';

        return Inertia::render('About', [
            'aboutContent' => $aboutContent,
        ]);
    }

    public function contact(): Response
    {
        return Inertia::render('Contact');
    }

    public function contactStore(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email'],
                'company' => ['nullable', 'string', 'max:255'],
                'subject' => ['required', 'string', 'in:general,services,partnership,other'],
                'message' => ['required', 'string', 'max:5000'],
            ]);

            $contactRequest = ContactRequest::create($validated);

            try {
                $adminEmail = config('mail.admin');
                if ($adminEmail) {
                    Mail::to($adminEmail)->send(new ContactRequestNotification($contactRequest));
                }
                Mail::to($contactRequest->email)->send(new ContactRequestConfirmation($contactRequest));
            } catch (\Throwable $e) {
                report($e);
                // Request is already saved; continue to success
            }

            return redirect()->route('contact')->with('success', true);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            return redirect()->route('contact')->with('error', __('Something went wrong. Please try again.'));
        }
    }

    public function services(): Response
    {
        $intro = Schema::hasTable('site_settings')
            ? SiteSetting::get('services_intro', 'We offer a range of professional services designed for businesses operating in the European Union. Each service is delivered with attention to local requirements and EU-wide standards.')
            : 'We offer a range of professional services designed for businesses operating in the European Union. Each service is delivered with attention to local requirements and EU-wide standards.';
        $services = Schema::hasTable('services')
            ? Service::ordered()->get()->toArray()
            : [];

        return Inertia::render('Services', [
            'servicesIntro' => $intro,
            'services' => $services,
        ]);
    }

    public function privacy(): Response
    {
        $privacyContent = Schema::hasTable('site_settings')
            ? SiteSetting::get('privacy_content', '')
            : '';

        return Inertia::render('Privacy', [
            'privacyContent' => $privacyContent,
        ]);
    }

    public function blog(): Response|SymfonyResponse
    {
        if (! Schema::hasTable('posts')) {
            abort(404);
        }

        $posts = Post::published()
            ->orderByDesc('published_at')
            ->get()
            ->map(fn (Post $post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => \Illuminate\Support\Str::limit(strip_tags($post->content), 160),
                'published_at' => $post->published_at->toIso8601String(),
            ]);

        if ($posts->isEmpty()) {
            abort(404);
        }

        return Inertia::render('Blog/Index', [
            'posts' => $posts,
        ]);
    }

    public function blogShow(Request $request, string $slug): Response|SymfonyResponse
    {
        if (! Schema::hasTable('posts')) {
            abort(404);
        }

        $post = Post::published()->where('slug', $slug)->first();

        if (! $post) {
            abort(404);
        }

        $ogImageUrl = $post->og_image ? asset('storage/' . $post->og_image) : null;

        return Inertia::render('Blog/Show', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'published_at' => $post->published_at->toIso8601String(),
                'meta_title' => $post->meta_title,
                'meta_description' => $post->meta_description,
                'og_image_url' => $ogImageUrl,
                'canonical_url' => $request->url(),
            ],
        ]);
    }

    public function sitemap(): Response|SymfonyResponse
    {
        return response()->xml(public_path('sitemap.xml'));
    }
}
