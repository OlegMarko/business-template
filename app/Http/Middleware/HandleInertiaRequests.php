<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $locale = app()->getLocale();
        $langPath = lang_path($locale . '/app.php');
        if (!is_file($langPath)) {
            $langPath = lang_path('en/app.php');
        }
        $translations = is_file($langPath) ? (require $langPath) : [];

        return [
            ...parent::share($request),
            'locale' => $locale,
            'translations' => $translations,
            'app' => [
                'name' => \Illuminate\Support\Facades\Schema::hasTable('site_settings')
                    ? SiteSetting::get('site_name', config('app.name'))
                    : config('app.name'),
            ],
            'hasPublishedPosts' => \Illuminate\Support\Facades\Schema::hasTable('posts')
                ? \App\Models\Post::published()->exists()
                : false,
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
        ];
    }
}
