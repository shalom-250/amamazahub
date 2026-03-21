import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, Link } from '@inertiajs/react';
import { Radio, Users, Heart, Share2, MessageCircle, Gift, X, ChevronRight } from 'lucide-react';
import { motion } from 'framer-motion';

export default function Live({ sessions }) {
    return (
        <AppLayout shadowSidebar={true}>
            <Head title="LIVE - AmazamaHub" />

            <div className="max-w-6xl mx-auto w-full py-12 px-6 pb-24 md:pb-12">
                <div className="flex items-center justify-between mb-12">
                    <div className="flex items-center space-x-4">
                        <div className="bg-primary p-3 rounded-2xl animate-pulse shadow-[0_0_20px_rgba(255,255,0,0.3)]">
                            <Radio size={28} className="text-black" />
                        </div>
                        <div>
                            <h1 className="text-3xl font-black italic tracking-tighter uppercase">LIVE Center</h1>
                            <p className="text-[10px] text-gray-500 font-black uppercase tracking-[0.2em]">Watch & Broadcast Live</p>
                        </div>
                    </div>

                    <Link
                        href="/live/create"
                        className="bg-red-600 hover:bg-red-500 text-white font-black italic px-8 py-3 rounded-2xl transition transform active:scale-95 shadow-2xl flex items-center space-x-3 uppercase text-xs tracking-widest"
                    >
                        <Radio size={18} />
                        <span>Go Live Now</span>
                    </Link>
                </div>

                {sessions.length > 0 ? (
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {sessions.map((stream) => (
                            <motion.div
                                key={stream.id}
                                whileHover={{ y: -8 }}
                                className="bg-gray-950 rounded-[40px] overflow-hidden border border-gray-900 hover:border-primary/20 transition-all duration-500 group shadow-2xl relative"
                            >
                                <Link href={`/live/${stream.id}`}>
                                    <div className="relative aspect-[4/5] overflow-hidden">
                                        <img
                                            src={stream.thumbnail_url || '/images/logo.png'}
                                            className="w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-60 group-hover:opacity-100"
                                        />
                                        <div className="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

                                        <div className="absolute top-6 left-6 flex space-x-2">
                                            <div className="bg-red-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center space-x-1.5 shadow-lg">
                                                <span className="w-1.5 h-1.5 bg-white rounded-full animate-ping"></span>
                                                <span>LIVE</span>
                                            </div>
                                            <div className="bg-black/40 backdrop-blur-md px-3 py-1 rounded-lg text-[10px] font-black flex items-center space-x-1.5 border border-white/5">
                                                <Users size={12} className="text-primary" />
                                                <span>{stream.viewers_count}</span>
                                            </div>
                                        </div>

                                        <div className="absolute bottom-8 left-8 right-8">
                                            <div className="flex items-center space-x-3 mb-3">
                                                <div className="w-8 h-8 rounded-lg overflow-hidden border border-primary/40">
                                                    <img src={stream.user.avatar || `https://ui-avatars.com/api/?name=${stream.user.username}`} className="w-full h-full object-cover" />
                                                </div>
                                                <p className="text-xs font-black italic text-white/90">@{stream.user.username}</p>
                                            </div>
                                            <p className="font-black italic text-lg text-white leading-tight pr-4 line-clamp-2 uppercase tracking-tighter">
                                                {stream.title}
                                            </p>
                                        </div>
                                    </div>
                                </Link>
                            </motion.div>
                        ))}
                    </div>
                ) : (
                    <div className="bg-gray-950 rounded-[40px] border border-gray-900 p-20 text-center flex flex-col items-center justify-center space-y-6 shadow-2xl">
                        <div className="w-24 h-24 rounded-full bg-gray-900 flex items-center justify-center text-gray-800">
                            <Radio size={48} className="opacity-20" />
                        </div>
                        <div className="space-y-2">
                            <h2 className="text-2xl font-black italic tracking-tighter uppercase text-white">No active broadcasts</h2>
                            <p className="text-sm text-gray-500 font-medium max-w-xs mx-auto">It's a bit quiet here. Why not be the first to start a live session?</p>
                        </div>
                        <Link
                            href="/live/create"
                            className="bg-primary text-black font-black italic px-10 py-4 rounded-2xl hover:scale-105 active:scale-95 transition transform shadow-2xl uppercase text-xs"
                        >
                            Start Broadcast
                        </Link>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}
