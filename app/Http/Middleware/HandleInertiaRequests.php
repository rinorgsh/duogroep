<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'locale' => app()->getLocale(),
            'locales' => config('app.available_locales', ['nl', 'fr', 'en']),
            'translations' => fn () => $this->getTranslations(),
        ];
    }

    private function getTranslations(): array
    {
        $locale = app()->getLocale();
        $path = lang_path("{$locale}.json");

        if (file_exists($path)) {
            return json_decode(file_get_contents($path), true) ?? [];
        }

        $phpTranslations = [];
        $langDir = lang_path($locale);
        if (is_dir($langDir)) {
            foreach (glob("{$langDir}/*.php") as $file) {
                $key = basename($file, '.php');
                $phpTranslations[$key] = require $file;
            }
        }

        return $phpTranslations;
    }
}
