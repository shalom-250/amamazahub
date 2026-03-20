import React from 'react';
import VideoCard from './VideoCard';

export default function VideoFeed() {
    // Mock data for initial design
    const videos = [
        {
            id: 1,
            user: 'amazamahub_official',
            caption: 'Welcome to the future of short videos! #AmazamaHub #TikTokClone',
            music: 'Amazama Original Sound',
            likes: '1.2M',
            comments: '15.4K',
            saves: '120K',
            shares: '50K',
            url: 'https://sample-videos.com/video321/mp4/720/big_buck_bunny_720p_1mb.mp4'
        },
        {
            id: 2,
            user: 'laravel_master',
            caption: 'Building scalable apps with Laravel and React is so easy with Inertia.js 🚀',
            music: 'Coding Beats Vol 1',
            likes: '800K',
            comments: '5K',
            saves: '40K',
            shares: '10K',
            url: 'https://vjs.zencdn.net/v/oceans.mp4'
        },
        {
            id: 3,
            user: 'design_pro',
            caption: 'Check out this smooth snap scrolling implementation in Tailwind CSS.',
            music: 'Smooth Transitions',
            likes: '500K',
            comments: '2K',
            saves: '30K',
            shares: '5K',
            url: 'https://www.w3schools.com/html/movie.mp4'
        },
    ];

    return (
        <div className="w-full">
            {videos.map((video) => (
                <VideoCard key={video.id} video={video} />
            ))}
        </div>
    );
}
