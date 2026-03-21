import React, { useEffect, useRef, useState } from 'react';
import AppLayout from '../../Components/AppLayout';
import { Head, Link, router } from '@inertiajs/react';
import { Radio, Users, Heart, MessageCircle, Gift, X, Send, Share2, MoreHorizontal } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';

export default function Stream({ session, isHost, initialMessages = [], initialLikeCount = 0, initialIsLiked = false }) {
    const [viewers, setViewers] = useState(session.viewers_count);
    const [comments, setComments] = useState(initialMessages);
    const [likeCount, setLikeCount] = useState(initialLikeCount);
    const [isLiked, setIsLiked] = useState(initialIsLiked);
    const [newComment, setNewComment] = useState('');
    const [cameraError, setCameraError] = useState(false);
    const videoRef = useRef(null);
    const chatRef = useRef(null);

    useEffect(() => {
        if (chatRef.current) {
            chatRef.current.scrollTop = chatRef.current.scrollHeight;
        }
    }, [comments]);

    const requestCamera = async () => {
        if (isHost && navigator.mediaDevices.getUserMedia) {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                if (videoRef.current) {
                    videoRef.current.srcObject = stream;
                    setCameraError(false);
                }
            } catch (err) {
                console.error("Error accessing camera:", err);
                setCameraError(true);
            }
        }
    };

    useEffect(() => {
        requestCamera();

        // Polling for updates
        const interval = setInterval(() => {
            axios.get(`/live/${session.id}/sync`).then(res => {
                setViewers(res.data.viewers);
                setLikeCount(res.data.likes);
                if (res.data.newMessages.length > 0) {
                    // Avoid duplicates
                    setComments(prev => {
                        const existingIds = new Set(prev.map(c => c.id));
                        const filteredNew = res.data.newMessages.filter(c => !existingIds.has(c.id));
                        return [...prev, ...filteredNew.reverse()];
                    });
                }
            });
        }, 3000);

        return () => clearInterval(interval);
    }, [isHost, session.id]);

    const handleSendComment = (e) => {
        e.preventDefault();
        if (!newComment.trim()) return;

        axios.post(`/live/${session.id}/message`, { message: newComment })
            .then(res => {
                setComments([...comments, res.data]);
                setNewComment('');
            });
    };

    const handleLike = () => {
        axios.post(`/live/${session.id}/like`).then(res => {
            setIsLiked(res.data.liked);
            setLikeCount(res.data.count);
        });
    };

    const handleShare = () => {
        navigator.clipboard.writeText(window.location.href);
        alert('Stream link copied to clipboard!');
    };

    const handleEndLive = () => {
        if (confirm('Are you sure you want to end this live?')) {
            router.post(`/live/${session.id}/end`);
        }
    };

    return (
        <AppLayout hideSidebar={true}>
            <Head title={`LIVE: ${session.title}`} />

            <div className="flex flex-col lg:flex-row h-[100vh] bg-black overflow-hidden relative">
                {/* Video Area */}
                <div className="flex-1 relative bg-gray-950 flex items-center justify-center group overflow-hidden">
                    {isHost ? (
                        <>
                            <video ref={videoRef} autoPlay muted playsInline className={`w-full h-full object-cover scale-x-[-1] ${cameraError ? 'hidden' : ''}`} />
                            {cameraError && (
                                <div className="absolute inset-0 flex flex-col items-center justify-center space-y-6 bg-gray-950 p-12 text-center">
                                    <div className="bg-red-500/10 p-6 rounded-full">
                                        <Radio size={64} className="text-red-500" />
                                    </div>
                                    <div className="space-y-2 max-w-sm">
                                        <h3 className="text-xl font-black italic tracking-tighter text-white uppercase">Camera blocked</h3>
                                        <p className="text-xs text-gray-400 font-medium mb-4">We can't access your camera or microphone. Please check your browser permissions to start the broadcast.</p>
                                        <button
                                            onClick={requestCamera}
                                            className="bg-white text-black font-black italic px-8 py-3 rounded-2xl hover:scale-105 active:scale-95 transition transform uppercase text-[10px] tracking-widest shadow-2xl"
                                        >
                                            Retry Permission
                                        </button>
                                    </div>
                                </div>
                            )}
                        </>
                    ) : (
                        <div className="relative w-full h-full">
                            <img src={session.thumbnail_url} className="w-full h-full object-cover blur-3xl opacity-30" />
                            <div className="absolute inset-0 flex flex-col items-center justify-center space-y-6">
                                <Radio size={64} className="text-primary animate-pulse" />
                                <h2 className="text-2xl font-black italic tracking-tighter text-white">WATCHING BROADCAST</h2>
                            </div>
                        </div>
                    )}

                    {/* Overlay UI */}
                    <div className="absolute inset-0 p-8 flex flex-col justify-between pointer-events-none">
                        <div className="flex items-start justify-between pointer-events-auto">
                            <div className="flex items-center space-x-4 bg-black/40 backdrop-blur-md p-2 pr-4 rounded-2xl border border-white/5">
                                <div className="w-10 h-10 rounded-xl overflow-hidden border border-primary">
                                    <img src={session.user.avatar || `https://ui-avatars.com/api/?name=${session.user.username}`} className="w-full h-full object-cover" />
                                </div>
                                <div>
                                    <p className="text-xs font-black italic text-white leading-none">@{session.user.username}</p>
                                    <p className="text-[8px] text-primary font-black uppercase tracking-widest mt-1">Live Host</p>
                                </div>
                            </div>

                            <div className="flex items-center space-x-3">
                                <div className="bg-red-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center space-x-2 shadow-xl">
                                    <span className="w-1.5 h-1.5 bg-white rounded-full animate-ping"></span>
                                    <span>LIVE</span>
                                </div>
                                <div className="bg-black/40 backdrop-blur-md px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest flex items-center space-x-2 border border-white/5 shadow-xl">
                                    <Users size={12} className="text-primary" />
                                    <span className="text-white">{viewers}</span>
                                </div>
                                <button onClick={() => isHost ? handleEndLive() : router.get('/live')} className="p-2 bg-black/40 backdrop-blur-md rounded-xl border border-white/5 text-white hover:bg-white/10 transition">
                                    <X size={20} />
                                </button>
                            </div>
                        </div>

                        <div className="flex justify-between items-end pointer-events-auto">
                            <div className="w-full max-w-sm space-y-4">
                                {/* Chat Area */}
                                <div
                                    ref={chatRef}
                                    className="h-64 overflow-y-auto no-scrollbar space-y-3 p-4 bg-gradient-to-t from-black/60 to-transparent"
                                >
                                    <AnimatePresence>
                                        {comments.map((comment) => (
                                            <motion.div
                                                key={comment.id}
                                                initial={{ opacity: 0, x: -20 }}
                                                animate={{ opacity: 1, x: 0 }}
                                                className="bg-black/30 backdrop-blur-sm p-3 rounded-2xl border border-white/5 self-start inline-block max-w-[90%]"
                                            >
                                                <p className="text-[10px] font-black italic text-primary/80 mb-1">@{comment.user.username}</p>
                                                <p className="text-xs font-medium text-white leading-relaxed">{comment.message || comment.text}</p>
                                            </motion.div>
                                        ))}
                                    </AnimatePresence>
                                </div>

                                {/* Chat Input */}
                                <form onSubmit={handleSendComment} className="flex items-center space-x-3 bg-black/40 backdrop-blur-md p-2 rounded-2xl border border-white/5 group focus-within:border-primary/30 transition">
                                    <input
                                        type="text"
                                        value={newComment}
                                        onChange={(e) => setNewComment(e.target.value)}
                                        placeholder="Say something nice..."
                                        className="flex-1 bg-transparent border-none focus:ring-0 text-sm font-medium text-white placeholder-gray-500 pl-4"
                                    />
                                    <button type="submit" className="p-3 bg-primary rounded-xl text-black hover:scale-105 active:scale-95 transition">
                                        <Send size={18} />
                                    </button>
                                </form>
                            </div>

                            <div className="flex flex-col space-y-4 items-center">
                                <div className="flex flex-col items-center space-y-1">
                                    <button
                                        onClick={handleLike}
                                        className={`p-4 backdrop-blur-md rounded-2xl border border-white/5 transition shadow-xl ${isLiked ? 'bg-red-500 text-white' : 'bg-black/40 text-white hover:bg-red-500/20 hover:text-red-500'}`}
                                    >
                                        <Heart size={24} fill={isLiked ? 'currentColor' : 'none'} />
                                    </button>
                                    <span className="text-[10px] font-black text-white/60 uppercase">{likeCount}</span>
                                </div>
                                <button className="p-4 bg-black/40 backdrop-blur-md rounded-2xl border border-white/5 text-white hover:bg-yellow-500/20 hover:text-yellow-500 transition shadow-xl"><Gift size={24} /></button>
                                <button
                                    onClick={handleShare}
                                    className="p-4 bg-primary rounded-2xl text-black hover:scale-110 transition shadow-2xl"
                                >
                                    <Share2 size={24} />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Right Side (Optional: Live Info for viewers) */}
                <div className="hidden lg:flex w-80 bg-black border-l border-white/5 flex-col p-8 space-y-8">
                    <div>
                        <h2 className="text-xl font-black italic tracking-tighter text-white uppercase mb-2">{session.title}</h2>
                        <p className="text-xs font-medium text-gray-400 leading-relaxed">{session.description || 'No description provided.'}</p>
                    </div>

                    <div className="space-y-4">
                        <h3 className="text-[10px] font-black italic text-gray-500 uppercase tracking-widest">About Host</h3>
                        <div className="flex items-center space-x-3">
                            <div className="w-10 h-10 rounded-xl overflow-hidden bg-gray-900">
                                <img src={session.user.avatar || `https://ui-avatars.com/api/?name=${session.user.username}`} className="w-full h-full object-cover" />
                            </div>
                            <div>
                                <p className="text-sm font-black italic text-white">@{session.user.username}</p>
                                <p className="text-[10px] text-gray-500 font-bold">{session.user.name}</p>
                            </div>
                        </div>
                    </div>

                    <div className="mt-auto">
                        <Link
                            href="/live"
                            className="w-full bg-gray-900 border border-white/5 py-4 rounded-2xl font-black italic text-xs uppercase tracking-widest text-white hover:bg-gray-800 transition flex items-center justify-center"
                        >
                            More Streams
                        </Link>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
