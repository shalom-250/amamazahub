import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head } from '@inertiajs/react';
import { MessageSquare, MoreHorizontal, Send } from 'lucide-react';

export default function Messages() {
    const contacts = [
        { id: 1, name: 'TikTok Admin', lastMsg: 'Welcome to Amazama!', time: '12:45' },
        { id: 2, name: 'Trending Hub', lastMsg: 'Check out the new global trends', time: 'Yesterday' },
        { id: 3, name: 'User_442', lastMsg: 'Your video is trending!', time: '2 days ago' },
    ];

    return (
        <AppLayout>
            <Head title="Messages" />
            <div className="grid grid-cols-1 md:grid-cols-3 h-full border-l border-gray-900 overflow-hidden">
                {/* Contacts List */}
                <div className="col-span-1 border-r border-gray-900 flex flex-col h-full bg-black">
                    <div className="p-6 border-b border-gray-900 flex justify-between items-center">
                        <h1 className="text-2xl font-black italic">Messages</h1>
                        <MoreHorizontal className="text-gray-500 cursor-pointer" />
                    </div>
                    <div className="flex-1 overflow-y-auto custom-scrollbar">
                        {contacts.map(c => (
                            <div key={c.id} className="p-4 flex items-center space-x-4 hover:bg-gray-900 cursor-pointer border-b border-gray-900/50">
                                <div className="w-12 h-12 rounded-full bg-gradient-to-tr from-gray-800 to-primary flex items-center justify-center font-bold">
                                    {c.name[0]}
                                </div>
                                <div className="flex-1 min-w-0">
                                    <div className="flex justify-between items-center">
                                        <h4 className="font-bold truncate text-sm">{c.name}</h4>
                                        <span className="text-[10px] text-gray-500">{c.time}</span>
                                    </div>
                                    <p className="text-xs text-gray-500 truncate">{c.lastMsg}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Empty Chat State */}
                <div className="hidden md:flex flex-col col-span-2 items-center justify-center p-10 text-center space-y-4">
                    <div className="bg-gray-900 p-8 rounded-full">
                        <MessageSquare size={64} className="text-gray-700" />
                    </div>
                    <div>
                        <h2 className="text-xl font-bold">Direct Messages</h2>
                        <p className="text-gray-500 text-sm mt-2 max-w-sm mx-auto">Send messages to your friends or start a group chat. Reach out to anyone on AmazamaHub!</p>
                    </div>
                    <button className="bg-primary text-black font-black px-8 py-2 rounded-md hover:bg-primary/90 transition shadow-lg shadow-primary/20">
                        Start chatting
                    </button>
                </div>
            </div>
        </AppLayout>
    );
}
