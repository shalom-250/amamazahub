import React, { useState } from 'react';
import Navbar from '../Components/Navbar';
import Sidebar from '../Components/Sidebar';
import VideoFeed from '../Components/VideoFeed';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { Home, Search, Plus, MessageSquare, User, Compass } from 'lucide-react';

export default function Welcome() {
    const [activeTab, setActiveTab] = useState('foryou');

    return (
        <div className="bg-black text-white h-screen flex flex-col overflow-hidden">
            <Head title="Home" />

            <Navbar />

            <div className="flex flex-1 overflow-hidden max-w-[1600px] mx-auto w-full relative">
                {/* Desktop Left Sidebar */}
                <div className="hidden lg:block w-72 h-full">
                    <Sidebar />
                </div>

                {/* Mobile/Small Screen Mini Sidebar */}
                <div className="hidden md:flex lg:hidden w-20 flex-col items-center py-4 space-y-8 h-full bg-black border-r border-gray-900">
                    <Home size={32} className="text-primary cursor-pointer hover:scale-110 transition" />
                    <Compass size={32} className="text-white cursor-pointer hover:scale-110 transition" />
                    <Plus size={32} className="text-white cursor-pointer hover:scale-110 transition" />
                    <MessageSquare size={32} className="text-white cursor-pointer hover:scale-110 transition" />
                    <User size={32} className="text-white cursor-pointer hover:scale-110 transition" />
                </div>

                {/* Main Content Area */}
                <main className="flex-1 relative flex flex-col min-w-0">
                    {/* Floating For You / Following Tabs (Top) */}
                    <div className="absolute top-4 left-0 right-0 z-20 flex justify-center space-x-8 text-lg font-bold drop-shadow-md">
                        <button
                            onClick={() => setActiveTab('following')}
                            className={`relative pb-1 ${activeTab === 'following' ? 'text-white' : 'text-white/60 hover:text-white/80'} transition`}
                        >
                            For You
                            {activeTab === 'following' && <motion.div layoutId="tab" className="absolute bottom-0 left-0 right-0 h-1 bg-white rounded-full" />}
                        </button>
                        <button
                            onClick={() => setActiveTab('foryou')}
                            className={`relative pb-1 ${activeTab === 'foryou' ? 'text-white' : 'text-white/60 hover:text-white/80'} transition`}
                        >
                            Following
                            {activeTab === 'foryou' && <motion.div layoutId="tab" className="absolute bottom-0 left-0 right-0 h-1 bg-white rounded-full" />}
                        </button>
                    </div>

                    {/* Vertical Snap Scroll Feed */}
                    <div className="flex-1 overflow-y-auto video-container">
                        <VideoFeed />
                    </div>
                </main>
            </div>

            {/* Mobile Bottom Navigation (Visible on small screens only) */}
            <div className="md:hidden border-t border-gray-800 h-16 bg-black flex justify-around items-center px-4 fixed bottom-0 left-0 right-0 z-50">
                <button className="text-white flex flex-col items-center">
                    <Home size={24} />
                    <span className="text-[10px] mt-1 font-bold">Home</span>
                </button>
                <button className="text-gray-400 flex flex-col items-center">
                    <Search size={24} />
                    <span className="text-[10px] mt-1">Search</span>
                </button>
                <button className="relative group mx-2">
                    <div className="bg-white rounded-lg px-3 py-1.5 flex items-center justify-center relative z-10">
                        <Plus size={20} className="text-black" />
                    </div>
                    {/* TikTok Plus button style */}
                    <div className="absolute inset-0 bg-primary -left-1 rounded-lg"></div>
                    <div className="absolute inset-0 bg-cyan-400 -right-1 rounded-lg"></div>
                </button>
                <button className="text-gray-400 flex flex-col items-center">
                    <MessageSquare size={24} />
                    <span className="text-[10px] mt-1">Inbox</span>
                </button>
                <button className="text-gray-400 flex flex-col items-center">
                    <User size={24} />
                    <span className="text-[10px] mt-1">Profile</span>
                </button>
            </div>
        </div>
    );
}
