<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PageController extends Controller
{
    private array $services = [
        [
            'slug' => 'kantoren-schoonmaken',
            'icon' => 'office',
            'image' => '/images/services/offices.jpg',
            'name_key' => 'service_offices',
            'desc_key' => 'service_offices_desc',
            'long_desc_key' => 'service_offices_long_desc',
        ],
        [
            'slug' => 'schoonmaak-na-verbouwing',
            'icon' => 'construction',
            'image' => '/images/services/construction.jpg',
            'name_key' => 'service_construction',
            'desc_key' => 'service_construction_desc',
            'long_desc_key' => 'service_construction_long_desc',
        ],
        [
            'slug' => 'glazenwasserij',
            'icon' => 'windows',
            'image' => '/images/services/windows.jpg',
            'name_key' => 'service_windows',
            'desc_key' => 'service_windows_desc',
            'long_desc_key' => 'service_windows_long_desc',
        ],
        [
            'slug' => 'industriele-schoonmaak',
            'icon' => 'industrial',
            'image' => '/images/services/industrial.jpg',
            'name_key' => 'service_industrial',
            'desc_key' => 'service_industrial_desc',
            'long_desc_key' => 'service_industrial_long_desc',
        ],
        [
            'slug' => 'schoonmaak-gebouwen',
            'icon' => 'building',
            'image' => '/images/services/buildings.jpg',
            'name_key' => 'service_buildings',
            'desc_key' => 'service_buildings_desc',
            'long_desc_key' => 'service_buildings_long_desc',
        ],
        [
            'slug' => 'schoonmaak-scholen',
            'icon' => 'school',
            'image' => '/images/services/schools.jpg',
            'name_key' => 'service_schools',
            'desc_key' => 'service_schools_desc',
            'long_desc_key' => 'service_schools_long_desc',
        ],
        [
            'slug' => 'horeca-schoonmaak',
            'icon' => 'horeca',
            'image' => '/images/services/horeca.jpg',
            'name_key' => 'service_horeca',
            'desc_key' => 'service_horeca_desc',
            'long_desc_key' => 'service_horeca_long_desc',
        ],
        [
            'slug' => 'schoonmaak-appartementen',
            'icon' => 'apartment',
            'image' => '/images/services/apartments.jpg',
            'name_key' => 'service_apartments',
            'desc_key' => 'service_apartments_desc',
            'long_desc_key' => 'service_apartments_long_desc',
        ],
        [
            'slug' => 'parking-schoonmaak',
            'icon' => 'parking',
            'image' => '/images/services/parking.jpg',
            'name_key' => 'service_parking',
            'desc_key' => 'service_parking_desc',
            'long_desc_key' => 'service_parking_long_desc',
        ],
        [
            'slug' => 'dieptereiniging',
            'icon' => 'deep',
            'image' => '/images/services/deep-cleaning.jpg',
            'name_key' => 'service_deep',
            'desc_key' => 'service_deep_desc',
            'long_desc_key' => 'service_deep_long_desc',
        ],
    ];

    public function home()
    {
        return Inertia::render('Frontend/Home', [
            'services' => $this->services,
            'meta' => [
                'title' => __('messages.meta_home_title'),
                'description' => __('messages.meta_home_description'),
            ],
        ]);
    }

    public function services()
    {
        return Inertia::render('Frontend/Services', [
            'services' => $this->services,
            'meta' => [
                'title' => __('messages.meta_services_title'),
                'description' => __('messages.meta_services_description'),
            ],
        ]);
    }

    public function serviceDetail(string $locale, string $slug)
    {
        $service = collect($this->services)->firstWhere('slug', $slug);

        if (!$service) {
            abort(404);
        }

        $otherServices = collect($this->services)
            ->where('slug', '!=', $slug)
            ->shuffle()
            ->take(4)
            ->values()
            ->all();

        return Inertia::render('Frontend/ServiceDetail', [
            'service' => $service,
            'services' => $this->services,
            'otherServices' => $otherServices,
            'meta' => [
                'title' => __("messages.{$service['name_key']}") . ' | Duogroep',
                'description' => __("messages.{$service['desc_key']}"),
            ],
        ]);
    }

    public function about()
    {
        return Inertia::render('Frontend/About', [
            'meta' => [
                'title' => __('messages.meta_about_title'),
                'description' => __('messages.meta_about_description'),
            ],
        ]);
    }

    public function contact()
    {
        return Inertia::render('Frontend/Contact', [
            'meta' => [
                'title' => __('messages.meta_contact_title'),
                'description' => __('messages.meta_contact_description'),
            ],
        ]);
    }

    public function quote()
    {
        return Inertia::render('Frontend/Quote', [
            'services' => $this->services,
            'meta' => [
                'title' => __('messages.meta_quote_title'),
                'description' => __('messages.meta_quote_description'),
            ],
        ]);
    }

    public function thanks()
    {
        return Inertia::render('Frontend/Thanks');
    }

    public function privacy()
    {
        return Inertia::render('Frontend/Privacy');
    }

    public function terms()
    {
        return Inertia::render('Frontend/Terms');
    }

    public function landingAds()
    {
        return Inertia::render('Frontend/LandingAds', [
            'services' => $this->services,
            'meta' => [
                'title' => __('messages.meta_home_title'),
                'description' => __('messages.meta_home_description'),
            ],
        ]);
    }
}
