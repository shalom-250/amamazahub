import React, { useState, useEffect, useRef } from 'react';
import AppLayout from '../../Components/AppLayout';
import { Head, router } from '@inertiajs/react';
import { Radio, Send, X } from 'lucide-react';
import { motion } from 'framer-motion';

export default function Create() {
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [cameraPreviewError, setCameraPreviewError] = useState(false);
    const videoRef = useRef(null);

    useEffect(() => {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then(stream => {
                    if (videoRef.current) {
                        videoRef.current.srcObject = stream;
                        setCameraPreviewError(false);
                    }
                })
                .catch(err => {
                    console.error("Camera preview error:", err);
                    setCameraPreviewError(true);
                });
        }
    }, []);

    const handleSubmit = (e) => {
        e.preventDefault();
        if (!title.trim() || isSubmitting) return;

        setIsSubmitting(true);
        router.post('/live', { title, description }, {
            onFinish: () => setIsSubmitting(false),
        });
    };

    return (
        <AppLayout>
            <Head title="Go LIVE - AmazamaHub" />
            <div className="max-w-2xl mx-auto w-full py-12 px-6 pb-24 md:pb-12">
                <div className="bg-gray-950 rounded-[40px] border border-gray-900 overflow-hidden shadow-2xl">
                    <div className="p-10 space-y-8">
                        <div className="flex items-center space-x-4">
                            <div className="bg-red-600 p-3 rounded-2xl animate-pulse shadow-[0_0_20px_rgba(220,38,38,0.5)]">
                                <Radio size={24} className="text-white" />
                            </div>
                            <div>
                                <h1 className="text-2xl font-black italic tracking-tighter text-white uppercase">Go LIVE</h1>
                                <p className="text-xs text-gray-500 font-bold uppercase tracking-widest">Setup your broadcast</p>
                            </div>
                        </div>

                        {/* Camera Preview */}
                        <div className="relative aspect-video w-full rounded-2xl overflow-hidden bg-gray-950 border border-gray-900 group">
                            <video
                                ref={videoRef}
                                autoPlay
                                muted
                                playsInline
                                className={`w-full h-full object-cover scale-x-[-1] ${cameraPreviewError ? 'hidden' : ''}`}
                            />
                            {cameraPreviewError && (
                                <div className="absolute inset-0 flex flex-col items-center justify-center space-y-4 p-8 text-center bg-gray-950/80 backdrop-blur-sm">
                                    <X size={48} className="text-red-500/50" />
                                    <p className="text-[10px] text-gray-500 font-black uppercase tracking-[0.2em] max-w-[200px]">
                                        Camera permission denied. Enable it in your browser to go live.
                                    </p>
                                </div>
                            )}
                            <div className="absolute bottom-4 left-4 bg-black/60 backdrop-blur-md px-3 py-1 rounded-full text-[8px] font-black text-white/50 border border-white/5 uppercase tracking-widest group-hover:text-primary transition">
                                Pre-broadcast Preview
                            </div>
                        </div>

                        <form onSubmit={handleSubmit} className="space-y-6">
                            <div className="space-y-2">
                                <label className="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] ml-2">Broadcast Title</label>
                                <input
                                    type="text"
                                    value={title}
                                    onChange={(e) => setTitle(e.target.value)}
                                    placeholder="e.g. Cooking with Sarah 🍳"
                                    className="w-full bg-gray-900 border-2 border-transparent focus:border-primary/50 py-4 px-6 rounded-2xl text-white font-medium transition placeholder-gray-700"
                                    required
                                />
                            </div>

                            <div className="space-y-2">
                                <label className="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] ml-2">Description (Optional)</label>
                                <textarea
                                    value={description}
                                    onChange={(e) => setDescription(e.target.value)}
                                    placeholder="Tell your fans what this live is about..."
                                    className="w-full bg-gray-900 border-2 border-transparent focus:border-primary/50 py-4 px-6 rounded-2xl text-white font-medium transition placeholder-gray-700 aspect-video resize-none"
                                />
                            </div>

                            <button
                                type="submit"
                                disabled={isSubmitting}
                                className="w-full bg-primary hover:brightness-110 active:scale-95 text-black font-black italic py-4 rounded-2xl transition transform shadow-2xl flex items-center justify-center space-x-3 disabled:opacity-50"
                            >
                                <Send size={20} />
                                <span>{isSubmitting ? 'Starting...' : 'START BROADCAST'}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
