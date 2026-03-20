import React from 'react';
import { Home, Compass, Upload, MessageSquare, User, LogIn } from 'lucide-react';

export default function Sidebar() {
    const menus = [
        { name: 'Home', icon: <Home size={28} />, active: true },
        { name: 'Explore', icon: <Compass size={28} /> },
        { name: 'Upload', icon: <Upload size={28} /> },
        { name: 'Messages', icon: <MessageSquare size={28} /> },
        { name: 'Profile', icon: <User size={28} /> },
    ];

    return (
        <div className="p-4 space-y-2 h-full bg-black overflow-y-auto custom-scrollbar">
            <div className="space-y-1">
                {menus.map((item) => (
                    <button
                        key={item.name}
                        className={`flex items-center space-x-4 w-full p-3 rounded-lg font-bold text-lg hover:bg-gray-900 transition ${item.active ? 'text-primary' : 'text-white'}`}
                    >
                        <span className={item.active ? 'text-primary' : 'text-white'}>{item.icon}</span>
                        <span className="hidden lg:block">{item.name}</span>
                    </button>
                ))}
            </div>

            <div className="border-t border-gray-800 my-4 pt-4 px-2 hidden lg:block">
                <p className="text-gray-500 text-sm">Log in to follow creators, like videos, and view comments.</p>
                <button className="mt-4 w-full border border-primary text-primary font-bold py-3 rounded-md hover:bg-primary/10 transition flex items-center justify-center space-x-2">
                    <LogIn size={20} />
                    <span>Log in</span>
                </button>
            </div>

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
