import React, { useRef, useState, useEffect } from 'react';
import { Heart, MessageCircle, Share2, Bookmark, Music2, Plus, CheckCircle2 } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';

export default function VideoCard({ video }) {
    const videoRef = useRef(null);
    const [isPlaying, setIsPlaying] = useState(false);
    const [isLiked, setIsLiked] = useState(false);
    const [isFollowed, setIsFollowed] = useState(false);
    const [progress, setProgress] = useState(0);
    const [lastTap, setLastTap] = useState(0);
    const [showHeart, setShowHeart] = useState(null); // { x, y, id }

    const togglePlay = (e) => {
        // Handle double tap for like
        const now = Date.now();
        if (now - lastTap < 300) {
            handleDoubleTap(e);
            setLastTap(0);
            return;
        }
        setLastTap(now);

        if (videoRef.current.paused) {
            videoRef.current.play();
            setIsPlaying(true);
        } else {
            videoRef.current.pause();
            setIsPlaying(false);
        }
    };

    const handleDoubleTap = (e) => {
        const rect = e.currentTarget.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        setIsLiked(true);
        const id = Math.random();
        setShowHeart({ x, y, id });

        setTimeout(() => {
            setShowHeart(prev => prev?.id === id ? null : prev);
        }, 1000);
    };

    const handleTimeUpdate = () => {
        if (videoRef.current) {
            const p = (videoRef.current.currentTime / videoRef.current.duration) * 100;
            setProgress(p);
        }
    };

    // Simple Intersection Observer to autoplay/pause video on scroll
    useEffect(() => {
        const options = { threshold: 0.6 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    videoRef.current?.play().catch(() => { });
                    setIsPlaying(true);
                } else {
                    videoRef.current?.pause();
                    setIsPlaying(false);
                }
            });
        }, options);

        if (videoRef.current) observer.observe(videoRef.current);
        return () => observer.disconnect();
    }, []);

    return (
        <div className="video-card bg-black border-b border-gray-900 md:border-none">
            <div className="relative w-full md:max-w-[420px] h-full md:h-[calc(100vh-100px)] md:my-4 md:rounded-xl overflow-hidden bg-gray-900 shadow-2xl group">
                {/* Real Video Component */}
                <video
                    ref={videoRef}
                    onClick={togglePlay}
                    onTimeUpdate={handleTimeUpdate}
                    loop
                    playsInline
                    className="w-full h-full object-cover cursor-pointer"
                    src={video.url}
                />

                {/* Double Tap Heart Animation */}
                <AnimatePresence>
                    {showHeart && (
                        <motion.div
                            key={showHeart.id}
                            initial={{ scale: 0, opacity: 0 }}
                            animate={{ scale: 1.5, opacity: 1 }}
                            exit={{ scale: 2, opacity: 0 }}
                            style={{ left: showHeart.x - 40, top: showHeart.y - 40 }}
                            className="absolute pointer-events-none z-50 text-primary"
                        >
                            <Heart fill="currentColor" size={80} />
                        </motion.div>
                    )}
                </AnimatePresence>

                {!isPlaying && (
                    <div className="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <motion.div
                            initial={{ scale: 0 }}
                            animate={{ scale: 1 }}
                            className="bg-black/20 p-6 rounded-full"
                        >
                            <div className="w-12 h-12 border-t-2 border-primary rounded-full animate-spin"></div>
                        </motion.div>
                    </div>
                )}

                {/* Bottom Left Info */}
                <div className="absolute bottom-4 left-4 right-16 space-y-3 z-10 text-white drop-shadow-lg">
                    <motion.h3
                        initial={{ opacity: 0, x: -20 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        className="font-bold text-lg hover:underline cursor-pointer flex items-center"
                    >
                        @{video.user}
                        {video.user === 'amazamahub_official' && (
                            <CheckCircle2 size={16} className="ml-1 text-cyan-400 fill-cyan-400/20" />
                        )}
                    </motion.h3>
                    <p className="text-sm line-clamp-2 pr-4">{video.caption}</p>
                    <div className="flex items-center space-x-2 text-sm font-semibold truncate group/music">
                        <Music2 size={14} className="music-disc" />
                        <span className="hover:underline cursor-pointer">{video.music}</span>
                    </div>
                </div>

                {/* Right Sidebar Controls */}
                <div className="absolute bottom-6 right-2 flex flex-col items-center space-y-5 z-10">
                    {/* User Profile Info */}
                    <div className="relative mb-2">
                        <div className="w-12 h-12 rounded-full border-2 border-white overflow-hidden bg-primary/20 flex items-center justify-center font-bold text-white shadow-xl">
                            {video.user?.[0]?.toUpperCase() || 'U'}
                        </div>
                        <AnimatePresence>
                            {!isFollowed && (
                                <motion.button
                                    initial={{ scale: 0 }}
                                    animate={{ scale: 1 }}
                                    exit={{ scale: 0 }}
                                    onClick={() => setIsFollowed(true)}
                                    className="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-primary text-black rounded-full p-1 hover:scale-110 transition shadow-lg"
                                >
                                    <Plus size={12} strokeWidth={4} />
                                </motion.button>
                            )}
                        </AnimatePresence>
                    </div>

                    {/* Like Button */}
                    <div className="flex flex-col items-center group cursor-pointer" onClick={() => setIsLiked(!isLiked)}>
                        <motion.div
                            animate={isLiked ? { scale: [1, 1.3, 1] } : {}}
                            className={`w-12 h-12 bg-gray-800/40 backdrop-blur-md rounded-full flex items-center justify-center transition ${isLiked ? 'text-primary' : 'text-white'}`}
                        >
                            <Heart size={28} fill={isLiked ? 'currentColor' : 'none'} />
                        </motion.div>
                        <span className="text-xs font-bold mt-1 shadow-black text-white">{video.likes}</span>
                    </div>

                    {/* Other buttons... */}
                    <div className="flex flex-col items-center group cursor-pointer">
                        <div className="w-12 h-12 bg-gray-800/40 backdrop-blur-md rounded-full flex items-center justify-center text-white">
                            <MessageCircle size={28} />
                        </div>
                        <span className="text-xs font-bold mt-1 shadow-black text-white">{video.comments}</span>
                    </div>

                    <div className="flex flex-col items-center group cursor-pointer">
                        <div className="w-12 h-12 bg-gray-800/40 backdrop-blur-md rounded-full flex items-center justify-center text-white">
                            <Bookmark size={28} />
                        </div>
                        <span className="text-xs font-bold mt-1 shadow-black text-white">{video.saves}</span>
                    </div>

                    <div className="flex flex-col items-center group cursor-pointer">
                        <div className="w-12 h-12 bg-gray-800/40 backdrop-blur-md rounded-full flex items-center justify-center text-white">
                            <Share2 size={28} />
                        </div>
                        <span className="text-xs font-bold mt-1 shadow-black text-white">{video.shares}</span>
                    </div>

                    {/* Music Disc Icon */}
                    <div className="mt-4">
                        <div className="w-12 h-12 p-2 bg-gray-800/40 backdrop-blur-md rounded-full overflow-hidden music-disc border border-gray-700">
                            <div className="w-full h-full rounded-full bg-gradient-to-tr from-gray-900 to-primary flex items-center justify-center">
                                <Music2 size={16} />
                            </div>
                        </div>
                    </div>
                </div>

                {/* Video Progress Bar */}
                <div className="absolute bottom-0 left-0 right-0 h-[2px] bg-white/20 z-20">
                    <motion.div
                        className="h-full bg-white opacity-60"
                        style={{ width: `${progress}%` }}
                    />
                </div>
            </div>
        </div>
    );
}
