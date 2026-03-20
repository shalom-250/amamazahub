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
            url: 'https://v1.pexels.com/video-files/5847427/5847427-uhd_2160_3840_24fps.mp4'
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
            url: 'https://v1.pexels.com/video-files/7023156/7023156-uhd_2160_3840_25fps.mp4'
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
            url: 'https://v1.pexels.com/video-files/3209828/3209828-uhd_2560_1440_25fps.mp4'
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
