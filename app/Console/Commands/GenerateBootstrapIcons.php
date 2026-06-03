<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class GenerateBootstrapIcons extends Command
{
    protected $signature = 'icons:generate';
    protected $description = 'Scan and download used Bootstrap Icons';

    public function handle()
    {
        $paths = [
            resource_path('views'),
            resource_path('js'),
        ];

        $icons = [];

        foreach ($paths as $path) {
            $files = File::allFiles($path);

            foreach ($files as $file) {
                $content = File::get($file);

                preg_match_all('/bi bi-([a-z0-9-]+)/i', $content, $matches);

                if (!empty($matches[1])) {
                    $icons = array_merge($icons, $matches[1]);
                }
            }
        }

        $icons = array_unique($icons);

        $savePath = public_path('img/bootstrap-icons');

        if (!File::exists($savePath)) {
            File::makeDirectory($savePath, 0755, true);
        }

        foreach ($icons as $icon) {

            $url = "https://raw.githubusercontent.com/twbs/icons/main/icons/{$icon}.svg";

            $response = Http::get($url);

            if ($response->successful()) {

                File::put(
                    "{$savePath}/{$icon}.svg",
                    $response->body()
                );

                $this->info("Downloaded: {$icon}");
            } else {
                $this->error("Failed: {$icon}");
            }
        }

        $this->info('Done!');
    }
}
