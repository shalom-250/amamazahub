import React, { useState } from 'react';
import AppLayout from '../Components/AppLayout';
import VideoFeed from '../Components/VideoFeed';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';

export default function Welcome() {
    const [activeTab, setActiveTab] = useState('foryou');

    return (
        <AppLayout>
            <Head title="Home" />

            {/* Floating For You / Following Tabs (Top) */}
            <div className="absolute top-4 left-0 right-0 z-20 flex justify-center space-x-8 text-lg font-bold drop-shadow-md">
                <button
                    onClick={() => setActiveTab('following')}
                    className={`relative pb-1 ${activeTab === 'following' ? 'text-white' : 'text-white/60 hover:text-white/80'} transition`}
                >
                    Following
                    {activeTab === 'following' && <motion.div layoutId="tab" className="absolute bottom-0 left-0 right-0 h-1 bg-white rounded-full" />}
                </button>
                <button
                    onClick={() => setActiveTab('foryou')}
                    className={`relative pb-1 ${activeTab === 'foryou' ? 'text-white' : 'text-white/60 hover:text-white/80'} transition`}
                >
                    For You
                    {activeTab === 'foryou' && <motion.div layoutId="tab" className="absolute bottom-0 left-0 right-0 h-1 bg-white rounded-full" />}
                </button>
            </div>

            {/* Vertical Snap Scroll Feed */}
            <div className="flex-1 overflow-y-auto video-container">
                <VideoFeed />
            </div>
        </AppLayout>
    );
}
