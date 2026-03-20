import React from 'react';
import { Search, Plus, MoreVertical, MessageSquare, Bell, User } from 'lucide-react';

export default function Navbar() {
    return (
        <nav className="h-16 border-b border-gray-800/50 flex items-center justify-between px-4 md:px-6 bg-black/80 backdrop-blur-xl z-50 sticky top-0">
            <div className="flex items-center space-x-2 min-w-[150px]">
                <span className="text-primary text-2xl font-black italic tracking-tighter cursor-pointer">AMAZAMAHUB</span>
            </div>

            <div className="hidden md:flex bg-gray-800/50 border border-gray-700/50 rounded-full px-4 py-2 w-full max-w-[500px] items-center group focus-within:border-gray-500 transition">
                <input
                    type="text"
                    placeholder="Search accounts and videos"
                    className="bg-transparent border-none focus:ring-0 text-sm flex-1 placeholder-gray-500"
                />
                <span className="text-gray-600 px-2">|</span>
                <button className="text-gray-400 group-hover:text-white transition">
                    <Search size={20} />
                </button>
            </div>

            <div className="flex items-center space-x-4 min-w-[150px] justify-end">
                <button className="hidden sm:flex items-center space-x-2 bg-gray-800/40 hover:bg-gray-800 px-4 py-1.5 rounded-sm font-bold border border-gray-700/30 transition">
                    <Plus size={20} />
                    <span>Upload</span>
                </button>
                <button className="bg-primary text-black px-6 py-1.5 rounded-md font-bold hover:bg-primary/90 transition shadow-lg shadow-primary/20">
                    Log in
                </button>
                <button className="text-white hover:bg-gray-800 p-1 rounded-full transition">
                    <MoreVertical size={24} />
                </button>
            </div>
        </nav>
    );
}
