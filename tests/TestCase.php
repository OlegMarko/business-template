<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->ensureViteManifestExists();
    }

    /**
     * Ensure Vite manifest exists so views using @vite() do not throw in tests.
     * Uses a minimal manifest if the file is missing (e.g. when npm run build was not run).
     */
    protected function ensureViteManifestExists(): void
    {
        $path = public_path('build/manifest.json');
        if (file_exists($path)) {
            return;
        }
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $manifest = [
            'resources/css/app.css' => [
                'file' => 'assets/app.css',
                'isEntry' => true,
            ],
            'resources/js/app.js' => [
                'file' => 'assets/app.js',
                'imports' => [],
                'css' => ['assets/app.css'],
                'isEntry' => true,
            ],
        ];
        file_put_contents($path, json_encode($manifest, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}
