import React, { useState, useEffect, useRef } from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, usePage, Link } from '@inertiajs/react';
import { MessageSquare, MoreHorizontal, Send, ChevronLeft, Search, BadgeCheck, Users, Plus, Image as ImageIcon, Smile } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';
import axios from 'axios';

export default function Messages({ conversations: initialConversations }) {
    const { auth } = usePage().props;
    const [conversations, setConversations] = useState(initialConversations || []);
    const [selectedUser, setSelectedUser] = useState(null);
    const [messages, setMessages] = useState([]);
    const [newMessage, setNewMessage] = useState('');
    const [isSending, setIsSending] = useState(false);
    const [showUserSelector, setShowUserSelector] = useState(false);
    const [following, setFollowing] = useState([]);
    const messagesEndRef = useRef(null);

    const scrollToBottom = () => {
        messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
    };

    useEffect(() => {
        scrollToBottom();
    }, [messages]);

    const fetchMessages = async (user) => {
        try {
            const response = await axios.get(`/api/messages/${user.id}`);
            setMessages(response.data);
            setSelectedUser(user);
        } catch (error) {
            console.error('Error fetching messages', error);
        }
    };

    const handleSendMessage = async (e) => {
        e.preventDefault();
        if (!newMessage.trim() || !selectedUser || isSending) return;

        setIsSending(true);
        const tempMsg = {
            id: Date.now(),
            sender_id: auth.user.id,
            receiver_id: selectedUser.id,
            message: newMessage,
            created_at: new Date().toISOString()
        };
        
        setMessages([...messages, tempMsg]);
        setNewMessage('');

        try {
            await axios.post(`/api/messages/${selectedUser.id}`, {
                message: newMessage
            });
            // Optionally re-fetch to get real ID and timestamp
        } catch (error) {
            console.error('Error sending message', error);
        } finally {
            setIsSending(false);
        }
    };

    const fetchFollowing = async () => {
        try {
            const response = await axios.get('/api/following');
            setFollowing(response.data);
            setShowUserSelector(true);
        } catch (error) {
            console.error('Error fetching following users', error);
        }
    };

    const handleSelectUser = (user) => {
        fetchMessages(user);
        setShowUserSelector(false);
        
        // Add user to conversations list if not already there
        if (!conversations.find(c => c.id === user.id)) {
            setConversations([
                {
                    id: user.id,
                    name: user.name,
                    username: user.username,
                    avatar: user.avatar,
                    last_message: '',
                    last_message_time: 'Just now'
                },
                ...conversations
            ]);
        }
    };

    // Polling for new messages every 4 seconds
    useEffect(() => {
        if (!selectedUser) return;
        const interval = setInterval(() => {
            fetchMessages(selectedUser);
        }, 4000);
        return () => clearInterval(interval);
    }, [selectedUser]);

    return (
        <AppLayout>
            <Head title="Messages | AmazamaHub" />
            <div className="flex h-full bg-black border-l border-gray-900 overflow-hidden relative">
                
                {/* Conversations Sidebar */}
                <div className={`${selectedUser ? 'hidden md:flex' : 'flex'} w-full md:w-[350px] border-r border-gray-900 flex-col bg-black z-20`}>
                    <div className="p-6 border-b border-gray-900 flex justify-between items-center bg-black/50 backdrop-blur-md sticky top-0">
                        <h1 className="text-2xl font-black italic tracking-tighter uppercase">Messages</h1>
                        <div className="flex items-center space-x-3">
                             <div 
                                onClick={fetchFollowing}
                                className="p-2 hover:bg-gray-900 rounded-full transition cursor-pointer text-gray-400 hover:text-white"
                             >
                                <Plus size={22} />
                             </div>
                             <div className="p-2 hover:bg-gray-900 rounded-full transition cursor-pointer text-gray-400 hover:text-white">
                                <MoreHorizontal size={22} />
                             </div>
                        </div>
                    </div>

                    <div className="p-4">
                        <div className="relative group">
                            <input 
                                type="text" 
                                placeholder="Search messages" 
                                className="w-full bg-gray-900 border-none rounded-2xl py-3 px-10 text-xs font-bold focus:ring-1 focus:ring-primary/50 transition group-hover:bg-gray-800"
                            />
                            <Search className="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-600" size={16} />
                        </div>
                    </div>

                    <div className="flex-1 overflow-y-auto custom-scrollbar">
                        {conversations.length === 0 ? (
                            <div className="p-10 text-center space-y-4 opacity-30">
                                <MessageSquare size={48} className="mx-auto" />
                                <p className="text-[10px] uppercase font-black tracking-widest italic">No conversations yet</p>
                            </div>
                        ) : (
                            conversations.map(c => (
                                <motion.div 
                                    key={c.id} 
                                    whileHover={{ x: 5 }}
                                    onClick={() => fetchMessages(c)}
                                    className={`p-4 flex items-center space-x-4 cursor-pointer border-b border-gray-900/30 transition duration-300 ${selectedUser?.id === c.id ? 'bg-primary/5 border-l-4 border-l-primary' : 'hover:bg-gray-900/40'}`}
                                >
                                    <div className="w-14 h-14 rounded-full bg-gradient-to-tr from-gray-950 to-primary flex-shrink-0 border-2 border-gray-900 overflow-hidden shadow-xl">
                                        {c.avatar ? <img src={c.avatar} className="w-full h-full object-cover" /> : <span className="font-bold flex items-center justify-center h-full text-xl">{c.name[0]}</span>}
                                    </div>
                                    <div className="flex-1 min-w-0">
                                        <div className="flex justify-between items-center mb-1">
                                            <h4 className="font-black truncate text-sm italic tracking-tight">{c.name}</h4>
                                            <span className="text-[10px] text-gray-600 font-bold uppercase">{c.last_message_time}</span>
                                        </div>
                                        <p className="text-xs text-gray-500 truncate font-medium">{c.last_message || 'Start chatting...'}</p>
                                    </div>
                                </motion.div>
                            ))
                        )}
                    </div>
                </div>

                {/* Chat Window */}
                <div className={`${!selectedUser ? 'hidden md:flex' : 'flex'} flex-1 flex-col h-full bg-gray-950/20`}>
                    {selectedUser ? (
                        <div className="flex flex-col h-full relative">
                            {/* Chat Header */}
                            <div className="p-4 border-b border-gray-900 flex items-center justify-between bg-black/40 backdrop-blur-md sticky top-0 z-30">
                                <div className="flex items-center space-x-4">
                                    <button onClick={() => setSelectedUser(null)} className="md:hidden p-2 hover:bg-gray-900 rounded-full transition">
                                        <ChevronLeft size={24} />
                                    </button>
                                    <Link href={`/profile/@${selectedUser.username}`} className="flex items-center space-x-3 group">
                                        <div className="w-10 h-10 rounded-full overflow-hidden border border-white/5 shadow-lg group-hover:scale-110 transition">
                                            {selectedUser.avatar ? <img src={selectedUser.avatar} className="w-full h-full object-cover" /> : <div className="w-full h-full bg-primary/20 flex items-center justify-center font-bold text-primary">{selectedUser.name[0]}</div>}
                                        </div>
                                        <div>
                                            <h3 className="font-black italic text-sm tracking-tight flex items-center">
                                                {selectedUser.name}
                                                <BadgeCheck size={14} className="ml-1 text-blue-400" />
                                            </h3>
                                            <p className="text-[10px] text-gray-500 font-bold uppercase">@{selectedUser.username}</p>
                                        </div>
                                    </Link>
                                </div>
                                <div className="p-2 hover:bg-gray-900 rounded-full transition cursor-pointer text-gray-500 hover:text-white">
                                    <MoreHorizontal size={24} />
                                </div>
                            </div>

                            {/* Messages Container */}
                            <div className="flex-1 overflow-y-auto p-6 space-y-4 custom-scrollbar bg-gradient-to-b from-black to-transparent">
                                <AnimatePresence initial={false}>
                                    {messages.map((m) => (
                                        <motion.div 
                                            key={m.id}
                                            initial={{ opacity: 0, y: 10, scale: 0.95 }}
                                            animate={{ opacity: 1, y: 0, scale: 1 }}
                                            className={`flex ${m.sender_id === auth.user.id ? 'justify-end' : 'justify-start'}`}
                                        >
                                            <div className={`max-w-[75%] p-4 rounded-[24px] text-sm font-medium shadow-2xl relative ${
                                                m.sender_id === auth.user.id 
                                                ? 'bg-primary text-black rounded-tr-sm' 
                                                : 'bg-gray-900 text-white rounded-tl-sm border border-white/5'
                                            }`}>
                                                {m.message}
                                                <span className={`block text-[9px] mt-2 font-black uppercase opacity-60 ${m.sender_id === auth.user.id ? 'text-black/70' : 'text-gray-500'}`}>
                                                    {new Date(m.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
                                                </span>
                                            </div>
                                        </motion.div>
                                    ))}
                                </AnimatePresence>
                                <div ref={messagesEndRef} />
                            </div>

                            {/* Sticky Chat Input */}
                            <div className="p-6 bg-black/60 backdrop-blur-md border-t border-gray-900 sticky bottom-0">
                                <form onSubmit={handleSendMessage} className="flex items-center space-x-4">
                                    <div className="flex-1 bg-gray-900/80 border border-white/5 rounded-2xl flex items-center px-4 py-1.5 focus-within:border-primary/50 transition group">
                                        <button type="button" className="text-gray-500 hover:text-white p-2">
                                            <Plus size={22} />
                                        </button>
                                        <input 
                                            value={newMessage}
                                            onChange={(e) => setNewMessage(e.target.value)}
                                            placeholder="Write a message..."
                                            className="bg-transparent border-none flex-1 focus:ring-0 text-white text-sm py-3 px-2 placeholder:text-gray-600 font-medium"
                                        />
                                        <div className="flex items-center space-x-2 text-gray-500">
                                            <Smile size={20} className="hover:text-white cursor-pointer transition" />
                                            <ImageIcon size={20} className="hover:text-white cursor-pointer transition" />
                                        </div>
                                    </div>
                                    <motion.button 
                                        whileHover={{ scale: 1.05 }}
                                        whileTap={{ scale: 0.95 }}
                                        disabled={!newMessage.trim() || isSending}
                                        className="w-14 h-14 bg-primary text-black rounded-2xl flex items-center justify-center hover:brightness-110 shadow-lg shadow-primary/20 disabled:opacity-50 disabled:grayscale transition"
                                    >
                                        <Send size={24} strokeWidth={2.5} className="rotate-0" />
                                    </motion.button>
                                </form>
                            </div>
                        </div>
                    ) : (
                        /* Empty State */
                        <div className="flex-1 flex flex-col items-center justify-center p-10 text-center space-y-8 bg-gray-950/20 relative overflow-hidden">
                             <div className="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
                                  <div className="absolute top-[10%] left-[10%] -rotate-12"><MessageSquare size={120} /></div>
                                  <div className="absolute bottom-[20%] right-[15%] rotate-12"><Send size={150} /></div>
                                  <div className="absolute top-[40%] right-[5%] -rotate-6"><MessageSquare size={80} /></div>
                             </div>

                             <motion.div 
                                initial={{ scale: 0.5, opacity: 0 }}
                                animate={{ scale: 1, opacity: 1 }}
                                className="bg-gradient-to-br from-gray-900 to-gray-800 p-12 rounded-[50px] shadow-2xl relative z-10 border border-white/5"
                             >
                                <MessageSquare size={80} className="text-primary mx-auto drop-shadow-[0_0_20px_rgba(255,255,0,0.3)]" />
                             </motion.div>
                             
                             <div className="max-w-md space-y-4 relative z-10">
                                 <h2 className="text-4xl font-black italic tracking-tighter uppercase text-white">Your Inbox</h2>
                                 <p className="text-gray-500 text-sm font-medium leading-relaxed px-4">
                                     Send private photos, videos and messages to a friend. Start a conversation and share the best moments on AmazamaHub.
                                 </p>
                                 <motion.button 
                                    whileHover={{ y: -5 }}
                                    className="bg-primary text-black font-black italic uppercase tracking-widest text-xs px-10 py-4 rounded-2xl hover:brightness-110 transition shadow-2xl shadow-primary/20 border-b-4 border-black/20"
                                >
                                    New Message
                                </motion.button>
                             </div>
                        </div>
                    )}
                </div>
                {/* User Selector Modal */}
                <AnimatePresence>
                    {showUserSelector && (
                        <div className="absolute inset-0 z-[100] flex items-center justify-center p-4">
                            <motion.div 
                                initial={{ opacity: 0 }}
                                animate={{ opacity: 1 }}
                                exit={{ opacity: 0 }}
                                onClick={() => setShowUserSelector(false)}
                                className="absolute inset-0 bg-black/80 backdrop-blur-sm"
                            />
                            <motion.div 
                                initial={{ scale: 0.9, opacity: 0, y: 20 }}
                                animate={{ scale: 1, opacity: 1, y: 0 }}
                                exit={{ scale: 0.9, opacity: 0, y: 20 }}
                                className="bg-gray-950 border border-white/5 w-full max-w-md rounded-[32px] overflow-hidden flex flex-col shadow-2xl relative z-10"
                                onClick={(e) => e.stopPropagation()}
                            >
                                <div className="p-6 border-b border-white/5 flex items-center justify-between bg-black/40">
                                    <h2 className="text-xl font-black italic tracking-tighter uppercase">New Message</h2>
                                    <button onClick={() => setShowUserSelector(false)} className="p-2 hover:bg-gray-900 rounded-full transition text-gray-500">
                                        <Plus className="rotate-45" size={24} />
                                    </button>
                                </div>
                                <div className="p-4 bg-gray-900/50">
                                    <div className="relative group">
                                        <input 
                                            type="text" 
                                            placeholder="Find people you follow..." 
                                            className="w-full bg-black border-none rounded-xl py-3 px-10 text-xs font-bold focus:ring-1 focus:ring-primary/50 transition"
                                        />
                                        <Search className="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-600" size={16} />
                                    </div>
                                </div>
                                <div className="flex-1 overflow-y-auto max-h-[400px] custom-scrollbar p-2">
                                    <p className="px-4 py-2 text-[10px] uppercase font-black tracking-widest text-gray-600 mb-2">Following</p>
                                    {following.length === 0 ? (
                                        <div className="p-10 text-center space-y-3 opacity-30">
                                            <Users size={48} className="mx-auto" />
                                            <p className="text-[10px] uppercase font-black tracking-widest italic leading-relaxed">You are not following anyone yet.<br/>Go explore to find friends!</p>
                                        </div>
                                    ) : (
                                        following.map(user => (
                                            <div 
                                                key={user.id} 
                                                onClick={() => handleSelectUser(user)}
                                                className="p-3 flex items-center space-x-4 hover:bg-gray-900 rounded-2xl cursor-pointer transition group"
                                            >
                                                <div className="w-12 h-12 rounded-full overflow-hidden border border-white/5 bg-gray-800 shadow-lg group-hover:scale-105 transition">
                                                    {user.avatar ? <img src={user.avatar} className="w-full h-full object-cover" /> : <div className="w-full h-full flex items-center justify-center font-bold text-lg">{user.name[0]}</div>}
                                                </div>
                                                <div className="flex-1">
                                                    <h4 className="font-black italic text-sm tracking-tight flex items-center">
                                                        {user.name}
                                                        <BadgeCheck size={14} className="ml-1 text-blue-400" />
                                                    </h4>
                                                    <p className="text-[10px] text-gray-500 font-bold uppercase">@{user.username}</p>
                                                </div>
                                                <div className="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 transition">
                                                    <Send size={14} />
                                                </div>
                                            </div>
                                        ))
                                    )}
                                </div>
                            </motion.div>
                        </div>
                    )}
                </AnimatePresence>
            </div>
        </AppLayout>
    );
}
