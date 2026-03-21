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

class RwandanUserSeeder extends Seeder
{
    public function run(): void
    {
        $rwandanUsers = [
            ['name' => 'Keza Alice', 'username' => 'keza_alice', 'email' => 'keza@example.com'],
            ['name' => 'Mugisha Jean', 'username' => 'mugisha_j', 'email' => 'mugisha@example.com'],
            ['name' => 'Gisa Eric', 'username' => 'gisa_eric', 'email' => 'gisa@example.com'],
            ['name' => 'Ineza Marie', 'username' => 'ineza_m', 'email' => 'ineza@example.com'],
            ['name' => 'Manzi Bruno', 'username' => 'manzi_b', 'email' => 'manzi@example.com'],
            ['name' => 'Uwase Ange', 'username' => 'uwase_ange', 'email' => 'uwase@example.com'],
            ['name' => 'Shema Kevin', 'username' => 'shema_k', 'email' => 'shema@example.com'],
            ['name' => 'Mutoni Bella', 'username' => 'mutoni_b', 'email' => 'mutoni@example.com'],
            ['name' => 'Habimana Paul', 'username' => 'habimana_p', 'email' => 'habimana@example.com'],
            ['name' => 'Iradukunda Faith', 'username' => 'iradukunda_f', 'email' => 'iradukunda@example.com'],
        ];

        $users = [];
        foreach ($rwandanUsers as $userData) {
            $users[] = User::create([
                'name' => $userData['name'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'password' => Hash::make('Test1234@'),
                'avatar' => "https://i.pravatar.cc/150?u={$userData['username']}",
                'bio' => "Official AmazamaHub Creator from Rwanda 🇷🇼",
            ]);
        }

        foreach ($users as $user) {
            $categories = ['Trending', 'Comedy', 'Education', 'Gaming', 'Music', 'Vlogs'];
            $videos = [
                ['url' => 'https://vjs.zencdn.net/v/oceans.mp4', 'thumb' => 'https://images.pexels.com/photos/1001633/pexels-photo-1001633.jpeg?auto=compress&cs=tinysrgb&w=600'],
                ['url' => 'https://sample-videos.com/video321/mp4/720/big_buck_bunny_720p_1mb.mp4', 'thumb' => 'https://images.pexels.com/photos/1181244/pexels-photo-1181244.jpeg?auto=compress&cs=tinysrgb&w=600'],
                ['url' => 'https://www.w3schools.com/html/mov_bbb.mp4', 'thumb' => 'https://images.pexels.com/photos/1181263/pexels-photo-1181263.jpeg?auto=compress&cs=tinysrgb&w=600'],
            ];

            foreach ($videos as $vData) {
                $video = Video::create([
                    'user_id' => $user->id,
                    'video_url' => $vData['url'],
                    'thumbnail_url' => $vData['thumb'],
                    'caption' => "Muraho! This is my latest video from #Rwanda. Subscribe for more! 🇷🇼 #AmazamaHub #Kigali",
                    'category' => $categories[$user->id % count($categories)],
                    'music_name' => "Rwandan Vibes - {$user->name}",
                ]);

                $sampleComments = ["Beautiful! 🇷🇼", "Wow, Kigali!", "Great content!", "Amazing! 🔥", "Proud!"];
                // Multi-Table Deterministic Seeding (Likes, Comments, Bookmarks, Reposts, Shares)
                for ($i = 0; $i < 5; $i++) {
                    $u = $users[$i % count($users)];
                    Like::create(['user_id' => $u->id, 'video_id' => $video->id]);
                    Bookmark::create(['user_id' => $u->id, 'video_id' => $video->id]);
                    Repost::create(['user_id' => $u->id, 'video_id' => $video->id]);
                    Share::create(['user_id' => $u->id, 'video_id' => $video->id]);
                    $video->increment('likes_count');
                    $video->increment('bookmarks_count');
                    $video->increment('reposts_count');
                    $video->increment('shares_count');

                    if ($i < 3) {
                        Comment::create([
                            'user_id' => $u->id,
                            'video_id' => $video->id,
                            'comment_text' => $sampleComments[$i % count($sampleComments)]
                        ]);
                        $video->increment('comments_count');
                    }
                }
            }

            // Deterministic Follows
            for ($i = 0; $i < 4; $i++) {
                if ($users[$i]->id !== $user->id) {
                    Follow::firstOrCreate(['follower_id' => $user->id, 'following_id' => $users[$i]->id]);
                }
            }
        }

        // Deterministic Messages (Global)
        for ($i = 0; $i < count($users) - 1; $i++) {
            Message::create([
                'sender_id' => $users[$i]->id,
                'receiver_id' => $users[$i+1]->id,
                'message' => "Hello! Nice to meet you on AmazamaHub. 🇷🇼",
                'is_read' => false,
                'type' => 'text'
            ]);
        }
    }
}
