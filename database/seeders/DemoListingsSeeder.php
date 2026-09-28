<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Amenity;
use App\Models\Community;
use App\Models\Country;
use App\Models\Developer;
use App\Models\Project;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Sample data so the admin panel isn't empty while you test.
 * Everything here is clearly marked "Demo" so you can delete it later.
 * Safe to run more than once.
 */
class DemoListingsSeeder extends Seeder
{
    public function run(): void
    {
        $uae = Country::firstOrCreate(
            ['slug' => 'united-arab-emirates'],
            ['name' => 'United Arab Emirates', 'code' => 'AE', 'default_currency' => 'AED'],
        );

        $communities = collect(['Dubai Marina', 'Downtown Dubai', 'Palm Jumeirah'])
            ->mapWithKeys(fn ($name) => [
                $name => Community::firstOrCreate(
                    ['slug' => Str::slug($name)],
                    ['name' => $name, 'country_id' => $uae->id, 'is_featured' => true],
                ),
            ]);

        $developer = Developer::firstOrCreate(
            ['slug' => 'demo-developer'],
            ['name' => 'Demo Developer', 'description' => 'Placeholder developer for testing.'],
        );

        $agent = Agent::firstOrCreate(
            ['slug' => 'demo-agent'],
            [
                'name' => 'Demo Agent',
                'job_title' => 'Property Consultant',
                'email' => 'agent@example.com',
                'phone' => '+971500000000',
                'whatsapp' => '+971500000000',
                'languages' => 'English, Urdu, Hindi',
            ],
        );

        $project = Project::firstOrCreate(
            ['slug' => 'demo-tower'],
            [
                'name' => 'Demo Tower',
                'developer_id' => $developer->id,
                'community_id' => $communities['Downtown Dubai']->id,
                'status' => 'off-plan',
                'starting_price' => 1350000,
                'currency' => 'AED',
                'payment_plan_summary' => '60/40 payment plan',
                'description' => 'Placeholder off-plan project for testing.',
            ],
        );

        $amenities = collect(['Swimming Pool', 'Gym', 'Covered Parking', 'Balcony'])
            ->map(fn ($name) => Amenity::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name],
            ));

        $listings = [
            [
                'slug' => 'demo-2-bed-dubai-marina-sale',
                'title' => 'Demo: 2 Bedroom Apartment in Dubai Marina',
                'listing_type' => 'sale',
                'category' => 'ready',
                'price' => 2450000,
                'bedrooms' => 2,
                'bathrooms' => 3,
                'size_sqft' => 1280,
                'community' => 'Dubai Marina',
                'in_project' => false,
            ],
            [
                'slug' => 'demo-1-bed-downtown-off-plan',
                'title' => 'Demo: 1 Bedroom Off-Plan Apartment in Downtown Dubai',
                'listing_type' => 'sale',
                'category' => 'off-plan',
                'price' => 1350000,
                'bedrooms' => 1,
                'bathrooms' => 2,
                'size_sqft' => 780,
                'community' => 'Downtown Dubai',
                'in_project' => true,
            ],
            [
                'slug' => 'demo-3-bed-palm-jumeirah-rent',
                'title' => 'Demo: 3 Bedroom Villa on Palm Jumeirah',
                'listing_type' => 'rent',
                'category' => 'ready',
                'price' => 420000,
                'bedrooms' => 3,
                'bathrooms' => 4,
                'size_sqft' => 3100,
                'community' => 'Palm Jumeirah',
                'in_project' => false,
            ],
        ];

        foreach ($listings as $data) {
            $property = Property::firstOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'description' => 'Demo listing for testing the admin panel. Delete before launch.',
                    'listing_type' => $data['listing_type'],
                    'category' => $data['category'],
                    'status' => 'published',
                    'price' => $data['price'],
                    'currency' => 'AED',
                    'bedrooms' => $data['bedrooms'],
                    'bathrooms' => $data['bathrooms'],
                    'size_sqft' => $data['size_sqft'],
                    'community_id' => $communities[$data['community']]->id,
                    'project_id' => $data['in_project'] ? $project->id : null,
                    'developer_id' => $data['in_project'] ? $developer->id : null,
                    'agent_id' => $agent->id,
                    'published_at' => now(),
                ],
            );

            $property->amenities()->syncWithoutDetaching($amenities->pluck('id')->all());
        }
    }
}
