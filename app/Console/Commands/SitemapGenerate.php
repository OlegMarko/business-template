<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class SitemapGenerate extends Command
{
    protected $signature = 'sitemap:generate
                            {--output=public/sitemap.xml : Path to the output file}';

    protected $description = 'Generate sitemap.xml with static pages and published blog posts';

    public function handle(): int
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $outputPath = $this->option('output');

        $urls = [];

        // Static pages
        $static = ['/', '/about', '/services', '/contact', '/privacy'];
        foreach ($static as $path) {
            $urls[] = [
                'loc' => $baseUrl . $path,
                'lastmod' => now()->toDateString(),
                'changefreq' => $path === '/' ? 'weekly' : 'monthly',
                'priority' => $path === '/' ? '1.0' : '0.8',
            ];
        }

        // Blog index (if there are published posts)
        if (Schema::hasTable('posts') && Post::published()->exists()) {
            $urls[] = [
                'loc' => $baseUrl . '/blog',
                'lastmod' => now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];

            foreach (Post::published()->orderByDesc('published_at')->get() as $post) {
                $urls[] = [
                    'loc' => $baseUrl . '/blog/' . $post->slug,
                    'lastmod' => $post->updated_at->toDateString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                ];
            }
        }

        $xml = $this->buildXml($urls);

        $fullPath = base_path($outputPath);
        $dir = dirname($fullPath);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($fullPath, $xml);

        $this->info('Sitemap written to ' . $outputPath . ' (' . count($urls) . ' URLs).');

        return self::SUCCESS;
    }

    /**
     * @param array<int, array{loc: string, lastmod: string, changefreq: string, priority: string}> $urls
     */
    private function buildXml(array $urls): string
    {
        $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $u) {
            $out .= '  <url>' . "\n";
            $out .= '    <loc>' . htmlspecialchars($u['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>' . "\n";
            $out .= '    <lastmod>' . $u['lastmod'] . '</lastmod>' . "\n";
            $out .= '    <changefreq>' . $u['changefreq'] . '</changefreq>' . "\n";
            $out .= '    <priority>' . $u['priority'] . '</priority>' . "\n";
            $out .= '  </url>' . "\n";
        }

        $out .= '</urlset>';

        return $out;
    }
}
