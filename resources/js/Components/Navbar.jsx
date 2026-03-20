import React from 'react';
import { Search, Plus, MoreVertical, User } from 'lucide-react';
import { Link } from '@inertiajs/react';

export default function Navbar({ user }) {
    return (
        <nav className="h-16 border-b border-gray-800 flex items-center justify-between px-4 md:px-8 bg-black/80 backdrop-blur-xl sticky top-0 z-50">
            {/* Logo */}
            <Link href="/" className="flex items-center space-x-2 group">
                <div className="w-10 h-10 bg-gradient-to-tr from-primary to-cyan-400 rounded-lg flex items-center justify-center p-1.5 shadow-lg shadow-primary/20 group-hover:scale-110 transition duration-300">
                    <svg viewBox="0 0 24 24" className="w-full h-full text-black fill-current stroke-black" strokeWidth="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>
                <h1 className="text-2xl font-black italic tracking-tighter hover:text-primary transition duration-300">AMAZAMAHUB</h1>
            </Link>

            {/* Search */}
            <div className="hidden md:flex flex-1 max-w-md mx-8">
                <div className="relative w-full group">
                    <input
                        type="text"
                        placeholder="Search amazing videos"
                        className="w-full bg-gray-900/50 border border-gray-800 rounded-full py-2.5 px-6 pl-12 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition duration-300 group-hover:bg-gray-800/80"
                    />
                    <Search className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-hover:text-gray-300 transition duration-300" size={20} />
                </div>
            </div>

            {/* Actions */}
            <div className="flex items-center space-x-4">
                <Link href="/upload" className="flex items-center space-x-2 bg-gray-900 border border-gray-800 px-4 py-2 rounded-md font-bold hover:bg-gray-800 transition transform active:scale-95">
                    <Plus size={20} />
                    <span className="hidden sm:inline">Upload</span>
                </Link>

                {user ? (
                    <div className="flex items-center space-x-4">
                        <Link href="/profile" className="flex items-center space-x-2">
                            <div className="w-10 h-10 rounded-full bg-primary/20 border-2 border-primary flex items-center justify-center overflow-hidden">
                                {user.avatar ? (
                                    <img src={user.avatar} className="w-full h-full object-cover" alt="User Avatar" />
                                ) : (
                                    <span className="font-bold">{user.name[0]}</span>
                                )}
                            </div>
                        </Link>
                        <Link method="post" href="/logout" as="button" className="text-sm font-bold text-gray-400 hover:text-white transition">
                            Logout
                        </Link>
                    </div>
                ) : (
                    <div className="flex items-center space-x-4">
                        <Link href="/login" className="bg-primary text-black font-black px-6 py-2 rounded-md hover:bg-primary/90 transition transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                            Log in
                        </Link>
                        <MoreVertical className="text-gray-400 cursor-pointer hover:text-white transition" />
                    </div>
                )}
            </div>
        </nav>
    );
}
