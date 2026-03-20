import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, Link } from '@inertiajs/react';
import { Edit2, Grid, Lock, Heart, Share2 } from 'lucide-react';

export default function Profile() {
    return (
        <AppLayout>
            <Head title="Profile" />
            <div className="p-6 md:p-10 max-w-5xl mx-auto w-full pb-24 md:pb-6">
                {/* Header Profile Section */}
                <div className="flex items-start justify-between">
                    <div className="flex items-center space-x-6">
                        <div className="w-24 md:w-32 h-24 md:h-32 rounded-full bg-gradient-to-br from-gray-800 to-primary border-4 border-gray-900 p-1 flex items-center justify-center text-4xl font-black">
                            A
                        </div>
                        <div className="space-y-4">
                            <div>
                                <h1 className="text-2xl md:text-32 font-black italic">Amazama_User</h1>
                                <p className="text-md font-semibold text-gray-400">@amazama_user</p>
                            </div>
                            <button className="flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded font-bold border border-gray-700/50 transition">
                                <Edit2 size={16} />
                                <span>Edit profile</span>
                            </button>
                        </div>
                    </div>
                    <Share2 className="text-gray-500 cursor-pointer hover:text-white" />
                </div>

                {/* Stats */}
                <div className="flex space-x-8 mt-8 border-b border-gray-900 pb-6">
                    <div className="flex items-center space-x-2">
                        <span className="font-black text-xl italic">0</span>
                        <span className="text-gray-500 text-sm">Following</span>
                    </div>
                    <div className="flex items-center space-x-2">
                        <span className="font-black text-xl italic">240K</span>
                        <span className="text-gray-500 text-sm">Followers</span>
                    </div>
                    <div className="flex items-center space-x-2">
                        <span className="font-black text-xl italic">1.2M</span>
                        <span className="text-gray-500 text-sm">Likes</span>
                    </div>
                </div>

                {/* Bio */}
                <div className="py-6">
                    <p className="text-sm">No bio yet. Tap to add one!</p>
                </div>

                {/* Tabs */}
                <div className="flex border-b border-gray-900">
                    <button className="px-8 py-3 font-bold border-b-2 border-white flex items-center space-x-2">
                        <Grid size={18} />
                        <span>Videos</span>
                    </button>
                    <button className="px-8 py-3 font-bold text-gray-500 hover:text-white flex items-center space-x-2">
                        <Lock size={18} />
                        <span>Liked</span>
                    </button>
                </div>

                {/* Videos Grid Placeholder */}
                <div className="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-1 mt-4">
                    {[
                        'https://images.pexels.com/photos/1624496/pexels-photo-1624496.jpeg?auto=compress&cs=tinysrgb&w=400',
                        'https://images.pexels.com/photos/3408744/pexels-photo-3408744.jpeg?auto=compress&cs=tinysrgb&w=400',
                        'https://images.pexels.com/photos/442576/pexels-photo-442576.jpeg?auto=compress&cs=tinysrgb&w=400',
                        'https://images.pexels.com/photos/1671325/pexels-photo-1671325.jpeg?auto=compress&cs=tinysrgb&w=400',
                        'https://images.pexels.com/photos/442576/pexels-photo-442576.jpeg?auto=compress&cs=tinysrgb&w=400',
                        'https://images.pexels.com/photos/2161467/pexels-photo-2161467.jpeg?auto=compress&cs=tinysrgb&w=400'
                    ].map((url, i) => (
                        <div key={i} className="aspect-[9/16] bg-gray-900 rounded cursor-pointer relative group overflow-hidden transition transform hover:brightness-110">
                            <img src={url} className="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition" alt="video" />
                            <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition flex items-end p-2 pb-3">
                                <div className="flex items-center space-x-1 text-white text-[10px] font-bold">
                                    <Heart size={14} className="fill-white" />
                                    <span>{(Math.random() * 10).toFixed(1)}K</span>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </AppLayout>
    );
}
