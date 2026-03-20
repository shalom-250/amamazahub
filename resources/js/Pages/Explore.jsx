import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head } from '@inertiajs/react';
import { Search, TrendingUp, Music2 } from 'lucide-react';

export default function Explore() {
    const categories = ['Trending', 'Comedy', 'Education', 'Gaming', 'Music', 'Vlogs'];

    return (
        <AppLayout>
            <Head title="Explore" />
            <div className="p-6 max-w-4xl mx-auto space-y-8 pb-20 md:pb-6">
                {/* Search Bar */}
                <div className="bg-gray-900/50 rounded-xl p-4 border border-gray-800 flex items-center space-x-4">
                    <Search className="text-gray-500" />
                    <input
                        type="text"
                        placeholder="Search for more amazing videos..."
                        className="bg-transparent border-none focus:ring-0 w-full text-lg"
                    />
                </div>

                {/* Categories */}
                <div className="flex overflow-x-auto space-x-3 no-scrollbar scroll-smooth">
                    {categories.map(cat => (
                        <button key={cat} className="px-6 py-2 bg-gray-800 hover:bg-gray-700 rounded-full font-bold whitespace-nowrap transition">
                            {cat}
                        </button>
                    ))}
                </div>

                {/* Trending section mock */}
                <div className="space-y-4">
                    <div className="flex items-center justify-between">
                        <h2 className="text-xl font-bold flex items-center space-x-2">
                            <TrendingUp className="text-primary" />
                            <span>Trending Now</span>
                        </h2>
                        <button className="text-primary font-bold text-sm">See all</button>
                    </div>
                    <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
                        {[
                            'https://images.pexels.com/photos/2161467/pexels-photo-2161467.jpeg?auto=compress&cs=tinysrgb&w=600',
                            'https://images.pexels.com/photos/442576/pexels-photo-442576.jpeg?auto=compress&cs=tinysrgb&w=600',
                            'https://images.pexels.com/photos/1671325/pexels-photo-1671325.jpeg?auto=compress&cs=tinysrgb&w=600',
                            'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=600',
                            'https://images.pexels.com/photos/3408744/pexels-photo-3408744.jpeg?auto=compress&cs=tinysrgb&w=600',
                            'https://images.pexels.com/photos/1624496/pexels-photo-1624496.jpeg?auto=compress&cs=tinysrgb&w=600'
                        ].map((url, i) => (
                            <div key={i} className="aspect-[9/16] bg-gray-900 rounded-md overflow-hidden relative group cursor-pointer transition transform hover:scale-[1.02] active:scale-95">
                                <img src={url} className="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition" alt="trend" />
                                <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex flex-col justify-end p-3">
                                    <div className="flex items-center space-x-1 text-[11px] font-bold text-white/90">
                                        <Music2 size={12} className="text-primary" />
                                        <span className="truncate">Amazama Beat {i + 1}</span>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
