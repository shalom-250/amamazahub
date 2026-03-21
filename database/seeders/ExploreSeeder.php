<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Follow;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ExploreSeeder extends Seeder
{
    public function run(): void
    {
        $exploreUsers = [
            ['name' => 'Comedy King', 'username' => 'funny_king', 'email' => 'funny@example.com'],
            ['name' => 'Edu Tech', 'username' => 'edutech_pro', 'email' => 'edu@example.com'],
            ['name' => 'Gamer Girl', 'username' => 'gg_gamer', 'email' => 'gamer@example.com'],
            ['name' => 'Music Vibes', 'username' => 'music_vibes', 'email' => 'music@example.com'],
            ['name' => 'Vlog Life', 'username' => 'vlog_life', 'email' => 'vlog@example.com'],
        ];

        $users = [];
        foreach ($exploreUsers as $userData) {
            $users[] = User::create([
                'name' => $userData['name'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'password' => Hash::make('password'),
            ]);
        }

        foreach ($users as $user) {
            $categories = ['Trending', 'Comedy', 'Education', 'Gaming', 'Music', 'Vlogs'];
            $images = [
                 'https://images.pexels.com/photos/2161467/pexels-photo-2161467.jpeg?auto=compress&cs=tinysrgb&w=600',
                 'https://images.pexels.com/photos/442576/pexels-photo-442576.jpeg?auto=compress&cs=tinysrgb&w=600',
                 'https://images.pexels.com/photos/1671325/pexels-photo-1671325.jpeg?auto=compress&cs=tinysrgb&w=600',
                 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=600',
                 'https://images.pexels.com/photos/3408744/pexels-photo-3408744.jpeg?auto=compress&cs=tinysrgb&w=600',
                 'https://images.pexels.com/photos/1624496/pexels-photo-1624496.jpeg?auto=compress&cs=tinysrgb&w=600'
            ];

            for ($i = 0; $i < 6; $i++) {
                $video = Video::create([
                    'user_id' => $user->id,
                    'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
                    'thumbnail_url' => $images[$i],
                    'caption' => "Check out this amazing {$categories[$i]} content! #AmazamaHub #{$categories[$i]}",
                    'category' => $categories[$i],
                    'music_name' => "Original Sound - {$user->username}",
                ]);

                $sampleComments = ["Hilarious! 😂", "Very helpful!", "Skills! 🎮", "Love this track!", "Great vlog!", "Trending now!"];
                $commenters = array_rand($users, rand(1, 4));
                foreach ((array)$commenters as $idx) {
                    Comment::create(['user_id' => $users[$idx]->id, 'video_id' => $video->id, 'comment_text' => $sampleComments[array_rand($sampleComments)]]);
                    $video->increment('comments_count');
                }

                $likers = array_rand($users, rand(2, 5));
                foreach ((array)$likers as $idx) {
                    Like::create(['user_id' => $users[$idx]->id, 'video_id' => $video->id]);
                    $video->increment('likes_count');
                }
            }
        }
    }
}
