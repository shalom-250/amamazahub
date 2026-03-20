import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, Link } from '@inertiajs/react';
import { Heart, MessageCircle, Share2, Music, Flag, MoreHorizontal, Send, Bookmark, X } from 'lucide-react';
import { motion } from 'framer-motion';

export default function VideoDetail() {
    return (
        <AppLayout>
            <Head title="Video Detail - AmazamaHub" />

            <div className="flex flex-col lg:flex-row h-full bg-black">
                {/* Left: Video Player */}
                <div className="w-full lg:w-[65%] h-[60vh] lg:h-full bg-black relative flex items-center justify-center group overflow-hidden">
                    <img
                        src="https://images.pexels.com/photos/1624496/pexels-photo-1624496.jpeg?auto=compress&cs=tinysrgb&w=800"
                        className="max-h-full max-w-full object-contain"
                    />
                    <div className="absolute top-6 left-6 text-white hover:bg-white/10 p-2 rounded-full cursor-pointer transition">
                        <X size={28} />
                    </div>
                </div>

                {/* Right: Info & Comments */}
                <div className="w-full lg:w-[35%] h-full bg-black lg:border-l border-gray-900 flex flex-col">
                    <div className="p-8 border-b border-gray-900 bg-gray-950/20">
                        <div className="flex items-center justify-between mb-8">
                            <div className="flex items-center space-x-4">
                                <div className="w-12 h-12 rounded-full overflow-hidden border border-primary/20">
                                    <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=100" className="w-full h-full object-cover" />
                                </div>
                                <div className="space-y-0.5">
                                    <p className="font-black italic text-lg tracking-tight">tiktok_star</p>
                                    <p className="text-[10px] text-gray-500 font-black uppercase tracking-widest">Amazama Creator</p>
                                </div>
                            </div>
                            <button className="bg-primary text-black font-black px-6 py-2 rounded-lg text-sm hover:scale-105 active:scale-95 transition">Follow</button>
                        </div>

                        <p className="text-sm font-medium leading-relaxed text-gray-200 mb-6">Learning React on AmazamaHub! This platform is insane! 👨‍💻🚀 #coding #react #tiktokclone</p>

                        <div className="flex items-center space-x-2 text-primary font-black italic text-sm mb-6">
                            <Music size={16} />
                            <span>Original Sound - coding_vibes</span>
                        </div>

                        <div className="flex items-center justify-between">
                            <div className="flex space-x-6">
                                <div className="flex items-center space-x-2">
                                    <div className="p-2.5 bg-gray-900 rounded-full text-white cursor-pointer hover:text-red-500 transition"><Heart size={20} /></div>
                                    <span className="text-xs font-black italic">12.5k</span>
                                </div>
                                <div className="flex items-center space-x-2">
                                    <div className="p-2.5 bg-gray-900 rounded-full text-white cursor-pointer hover:text-primary transition"><MessageCircle size={20} /></div>
                                    <span className="text-xs font-black italic">843</span>
                                </div>
                                <div className="flex items-center space-x-2">
                                    <div className="p-2.5 bg-gray-900 rounded-full text-white cursor-pointer hover:text-primary transition"><Bookmark size={20} /></div>
                                    <span className="text-xs font-black italic">2,102</span>
                                </div>
                            </div>
                            <div className="p-2.5 bg-gray-900 rounded-full text-white cursor-pointer hover:text-primary transition"><Share2 size={20} /></div>
                        </div>
                    </div>

                    {/* Comments Area */}
                    <div className="flex-1 overflow-y-auto p-6 space-y-8 custom-scrollbar bg-black/40">
                        {[1, 2, 3, 4, 5].map((i) => (
                            <div key={i} className="flex space-x-4 group">
                                <div className="w-10 h-10 rounded-full overflow-hidden flex-shrink-0 bg-gray-900 border border-gray-800">
                                    <img src={`https://i.pravatar.cc/100?u=${i}`} className="w-full h-full object-cover" />
                                </div>
                                <div className="flex-1 space-y-1">
                                    <div className="flex items-center justify-between">
                                        <p className="text-xs font-black italic text-gray-400 uppercase tracking-widest">user_{i}99</p>
                                        <Heart size={14} className="text-gray-700 hover:text-red-500 cursor-pointer transition" />
                                    </div>
                                    <p className="text-sm font-medium text-gray-200">This layout is so clean! Definitely following this journey. ✨</p>
                                    <div className="flex items-center space-x-4 pt-1">
                                        <span className="text-[10px] text-gray-600 font-bold">2h</span>
                                        <span className="text-[10px] text-gray-500 font-black cursor-pointer hover:underline">Reply</span>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* Input Area */}
                    <div className="p-6 border-t border-gray-900 bg-black">
                        <div className="relative">
                            <input
                                type="text"
                                placeholder="Add comment..."
                                className="w-full bg-gray-900 border border-transparent focus:border-primary/50 py-4 px-6 pr-14 rounded-2xl text-sm font-medium transition"
                            />
                            <button className="absolute right-4 top-1/2 -translate-y-1/2 text-primary font-black italic px-2 py-1 hover:scale-110 active:scale-95 transition">Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
