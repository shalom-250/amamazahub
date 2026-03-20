import React from 'react';
import { Link } from '@inertiajs/react';
import { Home, Compass, Upload, MessageSquare, User, LogIn, Users } from 'lucide-react';
import { usePage } from '@inertiajs/react';

export default function Sidebar({ user }) {
    const { url } = usePage();

    const menus = [
        { name: 'Home', icon: <Home size={28} />, href: '/' },
        { name: 'Explore', icon: <Compass size={28} />, href: '/explore' },
        { name: 'Upload', icon: <Upload size={28} />, href: '/upload' },
        { name: 'Following', icon: <Users size={28} />, href: '/following' },
    ];

    if (user) {
        menus.push({ name: 'Profile', icon: <User size={28} />, href: '/profile' });
    }

    const isActive = (href) => {
        if (href === '/' && url === '/') return true;
        if (href !== '/' && url.startsWith(href)) return true;
        return false;
    };

    return (
        <div className="p-4 space-y-2 h-full bg-black overflow-y-auto custom-scrollbar">
            <div className="space-y-1">
                {menus.map((item) => (
                    <Link
                        key={item.name}
                        href={item.href}
                        className={`flex items-center justify-between w-full p-3 rounded-lg font-bold text-lg hover:bg-gray-900/50 transition group ${isActive(item.href) ? 'text-primary bg-primary/5' : 'text-white'}`}
                    >
                        <div className="flex items-center space-x-4">
                            <span className={isActive(item.href) ? 'text-primary' : 'text-white group-hover:text-primary transition-colors'}>{item.icon}</span>
                            <span className="hidden lg:block">{item.name}</span>
                        </div>
                        {item.name === 'LIVE' && (
                            <span className="hidden lg:block bg-primary text-black text-[10px] px-1.5 py-0.5 rounded font-black italic">LIVE</span>
                        )}
                    </Link>
                ))}
            </div>

            {!user && (
                <div className="border-t border-gray-800 my-4 pt-4 px-2 hidden lg:block">
                    <p className="text-gray-500 text-sm font-medium">Log in to follow creators, like videos, and view comments.</p>
                    <Link href="/login" className="mt-4 w-full border border-primary text-primary font-bold py-3 rounded-md hover:bg-primary/10 transition flex items-center justify-center space-x-2">
                        <LogIn size={20} />
                        <span>Log in</span>
                    </Link>
                </div>
            )}

            <div className="space-y-4 text-xs text-gray-500 font-semibold px-2 py-4 hidden lg:block">
                <div className="flex flex-wrap gap-2">
                    <span>About</span><span>Newsroom</span><span>Contact</span><span>Careers</span>
                </div>
                <div className="flex flex-wrap gap-2">
                    <span>Amazama for Good</span><span>Advertise</span><span>Developers</span>
                </div>
                <div className="flex flex-wrap gap-2">
                    <span>Help</span><span>Safety</span><span>Terms</span><span>Privacy</span>
                </div>
                <p className="pt-2">© 2026 AmazamaHub</p>
            </div>
        </div>
    );
}
