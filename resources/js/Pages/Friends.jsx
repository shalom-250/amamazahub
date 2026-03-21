import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, Link } from '@inertiajs/react';
import { Users, UserPlus, MessageCircle, Heart, Share2, Music } from 'lucide-react';
import { motion } from 'framer-motion';

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
                <div className="space-y-12">
                    {videos.length > 0 ? (
                        <div className="space-y-8">
                            <h2 className="text-sm font-black italic uppercase tracking-widest text-gray-500">Recent from friends</h2>
                            {videos.map((video) => (
                                <div key={video.id} className="bg-gray-900/40 rounded-[40px] overflow-hidden border border-gray-800 group transition hover:border-primary/20">
                                    <Link href={`/v/${video.id}`} className="block relative aspect-video bg-black">
                                        <video src={video.video_path} className="w-full h-full object-cover group-hover:scale-105 transition duration-700" muted onMouseOver={e => e.target.play()} onMouseOut={e => e.target.pause()} />
                                        <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500 p-8 flex flex-col justify-end">
                                            <p className="font-black italic text-lg">{video.title}</p>
                                        </div>
                                    </Link>
                                    <div className="p-6 flex items-center justify-between">
                                        <Link href={`/profile/@${video.user.username}`} className="flex items-center space-x-3">
                                            <div className="w-10 h-10 rounded-full border border-primary/20 overflow-hidden">
                                                <img src={video.user.avatar} className="w-full h-full object-cover" />
                                            </div>
                                            <div>
                                                <p className="text-sm font-black italic">@{video.user.username}</p>
                                                <p className="text-[10px] text-gray-500 font-bold uppercase">{video.created_at_human || 'Recently posted'}</p>
                                            </div>
                                        </Link>
                                        <div className="flex space-x-4 text-gray-500">
                                            <div className="flex items-center space-x-1">
                                                <Heart size={16} className={video.likes_exists ? 'text-primary fill-primary' : ''} />
                                                <span className="text-xs font-black">{video.likes_count}</span>
                                            </div>
                                            <div className="flex items-center space-x-1">
                                                <MessageCircle size={16} />
                                                <span className="text-xs font-black">{video.comments_count}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
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
