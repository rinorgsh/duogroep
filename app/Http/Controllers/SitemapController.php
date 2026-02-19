<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $locales = ['nl', 'fr', 'en'];
        $baseUrl = config('app.url');

        $services = [
            'kantoren-schoonmaken',
            'schoonmaak-na-verbouwing',
            'glazenwasserij',
            'industriele-schoonmaak',
            'schoonmaak-gebouwen',
            'schoonmaak-scholen',
            'horeca-schoonmaak',
            'schoonmaak-appartementen',
            'parking-schoonmaak',
            'dieptereiniging',
        ];

        $pages = ['', '/diensten', '/over-ons', '/contact', '/offerte', '/privacy', '/voorwaarden'];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

        foreach ($pages as $page) {
            foreach ($locales as $locale) {
                $xml .= '<url>';
                $xml .= "<loc>{$baseUrl}/{$locale}{$page}</loc>";
                foreach ($locales as $altLocale) {
                    $xml .= "<xhtml:link rel=\"alternate\" hreflang=\"{$altLocale}\" href=\"{$baseUrl}/{$altLocale}{$page}\"/>";
                }
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>' . ($page === '' ? '1.0' : '0.8') . '</priority>';
                $xml .= '</url>';
            }
        }

        foreach ($services as $service) {
            foreach ($locales as $locale) {
                $xml .= '<url>';
                $xml .= "<loc>{$baseUrl}/{$locale}/diensten/{$service}</loc>";
                $xml .= '<changefreq>monthly</changefreq>';
                $xml .= '<priority>0.7</priority>';
                $xml .= '</url>';
            }
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
