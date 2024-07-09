<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialNetwork::create([
            'facebook_url' =>'https://www.facebook.com',
            'twitter_url' =>'https://www.twitter',
            'instagram_url' =>'https://www.instagram.com',
            'youtube_url' =>'https://www.youtube',
            'github_url' =>'https://www.github.',
            'linkedin_url' =>'https://www.linkedin',
        ]);
    }
}
