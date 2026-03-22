import React, { useState, useEffect, useRef, useCallback } from 'react';
import AppLayout from '../Components/AppLayout';
import VideoFeed from '../Components/VideoFeed';
import { Head, router } from '@inertiajs/react';
import { motion } from 'framer-motion';

export default function Welcome({ videos, feedType }) {
    const [allVideos, setAllVideos] = useState(videos.data);
    const [nextPageUrl, setNextPageUrl] = useState(videos.next_page_url);
    const [loading, setLoading] = useState(false);
    const sentinelRef = useRef(null);

    // Reset when feedType changes (tab switch)
    useEffect(() => {
        setAllVideos(videos.data);
        setNextPageUrl(videos.next_page_url);
    }, [feedType]);

    const loadMore = useCallback(() => {
        if (!nextPageUrl || loading) return;
        setLoading(true);
        router.get(nextPageUrl, {}, {
            preserveState: true,
            preserveScroll: true,
            only: ['videos'],
            onSuccess: (page) => {
                setAllVideos(prev => [...prev, ...page.props.videos.data]);
                setNextPageUrl(page.props.videos.next_page_url);
                setLoading(false);
            },
            onError: () => setLoading(false),
        });
    }, [nextPageUrl, loading]);

    useEffect(() => {
        const observer = new IntersectionObserver(([entry]) => {
            if (entry.isIntersecting) loadMore();
        }, { threshold: 0.1 });
        if (sentinelRef.current) observer.observe(sentinelRef.current);
        return () => observer.disconnect();
    }, [loadMore]);

    const handleTabChange = (type) => {
        router.get('/', { type }, { preserveState: true });
    };

    return (
        <AppLayout>
            <Head title="Home" />
            <div className="absolute top-4 left-0 right-0 z-20 flex justify-center space-x-8 text-lg font-bold drop-shadow-md">
                <button
                    onClick={() => handleTabChange('following')}
                    className={`relative pb-1 ${feedType === 'following' ? 'text-white' : 'text-white/60 hover:text-white/80'} transition`}
                >
                    Following
                    {feedType === 'following' && <motion.div layoutId="tab" className="absolute bottom-0 left-0 right-0 h-1 bg-white rounded-full" />}
                </button>
                <button
                    onClick={() => handleTabChange('foryou')}
                    className={`relative pb-1 ${feedType === 'foryou' || !feedType ? 'text-white' : 'text-white/60 hover:text-white/80'} transition`}
                >
                    For You
                    {(feedType === 'foryou' || !feedType) && <motion.div layoutId="tab" className="absolute bottom-0 left-0 right-0 h-1 bg-white rounded-full" />}
                </button>
            </div>

            <div className="flex-1 overflow-y-auto video-container">
                <VideoFeed videos={allVideos} />

                {/* Infinite scroll sentinel */}
                <div ref={sentinelRef} className="h-16 flex items-center justify-center">
                    {loading && (
                        <div className="w-6 h-6 border-2 border-primary border-t-transparent rounded-full animate-spin" />
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
