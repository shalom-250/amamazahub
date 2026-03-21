import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, Link } from '@inertiajs/react';
import { Users, UserPlus, MessageCircle, Heart, Share2, Music } from 'lucide-react';
import { motion } from 'framer-motion';
import Watermark from '../Components/Watermark';

export default function Friends({ friends = [], videos = [], auth }) {
    return (
        <AppLayout>
            <Head title="Friends - AmazamaHub" />

            <div className="max-w-2xl mx-auto w-full py-8 px-4 pb-24 md:pb-8">
                <div className="flex items-center justify-between mb-8">
                    <h1 className="text-2xl font-black italic tracking-tighter uppercase">Friends</h1>
                    <Link href="/following" className="p-2 border border-gray-800 rounded-full hover:bg-gray-900 transition">
                        <UserPlus size={20} className="text-primary" />
                    </Link>
                </div>

                {/* Friends Horizontal Bar */}
                <div className="flex space-x-6 overflow-x-auto pb-4 mb-8 noscrollbar">
                    {friends.length > 0 ? (
                        friends.map((friend) => (
                            <Link href={`/profile/@${friend.username}`} key={friend.id} className="flex flex-col items-center space-y-2 flex-shrink-0 cursor-pointer group">
                                <div className="relative">
                                    <div className="w-16 h-16 rounded-full p-0.5 border-2 border-primary group-hover:scale-110 transition duration-300 shadow-lg shadow-primary/10">
                                        <img src={friend.avatar || `https://ui-avatars.com/api/?name=${friend.name}&background=ed7014&color=fff`} className="w-full h-full rounded-full object-cover" />
                                    </div>
                                    <div className="absolute bottom-1 right-1 w-3.5 h-3.5 bg-green-500 border-2 border-black rounded-full shadow-sm"></div>
                                </div>
                                <span className="text-[10px] font-black text-gray-400 italic">@{friend.username}</span>
                            </Link>
                        ))
                    ) : (
                        <div className="flex items-center space-x-4">
                            <div className="p-4 bg-gray-900/40 border border-dashed border-gray-800 rounded-2xl">
                                <p className="text-[8px] font-black text-gray-600 uppercase tracking-widest">No Mutual Friends Yet</p>
                            </div>
                        </div>
                    )}
                </div>

                {/* Feed Section */}
                <div className="space-y-6">
                    {videos.length > 0 ? (
                        <>
                            <h2 className="text-sm font-black italic uppercase tracking-widest text-gray-500 px-1">Recent from friends</h2>
                            <div className="grid grid-cols-2 gap-4">
                                {videos.map((video) => (
                                    <div key={video.id} className="relative aspect-[9/15] bg-gray-900 rounded-[24px] overflow-hidden group shadow-lg border border-white/5 hover:border-primary/30 transition-all duration-500">
                                        <Link href={`/v/${video.id}`} className="block w-full h-full">
                                            <video
                                                src={video.video_url}
                                                className="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                                muted
                                                onMouseOver={e => {
                                                    const playPromise = e.target.play();
                                                    if (playPromise !== undefined) {
                                                        playPromise.catch(() => { });
                                                    }
                                                }}
                                                onMouseOut={e => e.target.pause()}
                                            />
                                            <Watermark size="sm" className="bottom-2 right-2 scale-75 transform origin-bottom-right" />
                                            {/* Overlay Info */}
                                            <div className="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent p-4 flex flex-col justify-end">
                                                <div className="flex items-center space-x-2 mb-2">
                                                    <div className="w-6 h-6 rounded-full border border-primary/40 overflow-hidden bg-black/50">
                                                        <img src={video.user?.avatar || `https://ui-avatars.com/api/?name=${video.user?.username}`} className="w-full h-full object-cover" />
                                                    </div>
                                                    <span className="text-[10px] font-black italic text-white truncate shadow-sm">@{video.user?.username}</span>
                                                </div>
                                                <p className="text-[10px] font-bold text-white/90 line-clamp-1 italic tracking-tight mb-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    {video.title || video.caption}
                                                </p>
                                                <div className="flex items-center space-x-3 text-white/80">
                                                    <div className="flex items-center space-x-1">
                                                        <Heart size={12} className={video.likes_exists ? 'text-primary fill-primary' : ''} />
                                                        <span className="text-[10px] font-black">{video.likes_count}</span>
                                                    </div>
                                                    <div className="flex items-center space-x-1">
                                                        <MessageCircle size={12} />
                                                        <span className="text-[10px] font-black">{video.comments_count}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </Link>
                                    </div>
                                ))}
                            </div>
                        </>
                    ) : (
                        <div className="bg-gray-900/20 rounded-[40px] aspect-[9/10] flex flex-col items-center justify-center text-center p-12 border border-gray-900/50 shadow-2xl relative overflow-hidden">
                            <div className="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-20"></div>
                            <div className="bg-gray-800/80 backdrop-blur-md p-8 rounded-full mb-8 shadow-xl border border-gray-700 relative z-10">
                                <Users size={56} className="text-gray-500" />
                            </div>
                            <h2 className="text-2xl font-black italic mb-4 relative z-10 uppercase tracking-tighter">Your friends' feed</h2>
                            <p className="text-sm text-gray-500 font-bold max-w-xs leading-relaxed mb-10 relative z-10 italic">When your mutual friends post videos, they will appear here. Start following your friends to see what they are up to!</p>
                            <Link href="/following" className="bg-primary text-black font-black px-12 py-4 rounded-2xl hover:scale-105 active:scale-95 transition shadow-xl shadow-primary/20 relative z-10 uppercase italic text-sm">Find Friends</Link>
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
