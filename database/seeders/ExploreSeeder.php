<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Follow;
use App\Models\Bookmark;
use App\Models\Repost;
use App\Models\Share;
use App\Models\Message;
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
                 url('/images/logo.png'),
                 url('/images/logo.png'),
                 url('/images/logo.png'),
                 url('/images/logo.png'),
                 url('/images/logo.png'),
                 url('/images/logo.png')
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
                // Create 2 deterministic comments per video
                for ($k = 0; $k < 2; $k++) {
                    Comment::create([
                        'user_id' => $users[$k % count($users)]->id,
                        'video_id' => $video->id,
                        'comment_text' => $sampleComments[($i + $k) % count($sampleComments)]
                    ]);
                    $video->increment('comments_count');
                }

                // Multi-Table Deterministic Seeding (Likes, Comments, Bookmarks, Reposts, Shares)
                for ($k = 0; $k < 4; $k++) {
                    $u = $users[$k % count($users)];
                    Like::create(['user_id' => $u->id, 'video_id' => $video->id]);
                    Bookmark::create(['user_id' => $u->id, 'video_id' => $video->id]);
                    Repost::create(['user_id' => $u->id, 'video_id' => $video->id]);
                    Share::create(['user_id' => $u->id, 'video_id' => $video->id]);
                    $video->increment('likes_count');
                    $video->increment('bookmarks_count');
                    $video->increment('reposts_count');
                    $video->increment('shares_count');

                    if ($k < 2) {
                        Comment::create([
                            'user_id' => $u->id,
                            'video_id' => $video->id,
                            'comment_text' => $sampleComments[($i + $k) % count($sampleComments)]
                        ]);
                        $video->increment('comments_count');
                    }
                }
            }
        }

        // Deterministic Messages (Global)
        for ($i = 0; $i < count($users) - 1; $i++) {
            Message::create([
                'sender_id' => $users[$i]->id,
                'receiver_id' => $users[$i+1]->id,
                'message' => "Welcome to the explore section! 🌟",
                'is_read' => false,
                'type' => 'text'
            ]);
        }
    }
}
