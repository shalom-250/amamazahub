import React, { useState, useRef } from 'react';
import AppLayout from '../../Components/AppLayout';
import { Head, Link, router } from '@inertiajs/react';
import { ChevronLeft, Camera, User, AtSign, FileText, CheckCircle2 } from 'lucide-react';

export default function Edit({ auth }) {
    const user = auth?.user;

    const [name, setName]             = useState(user?.name || '');
    const [username, setUsername]     = useState(user?.username || '');
    const [bio, setBio]               = useState(user?.bio || '');
    const [avatarFile, setAvatarFile] = useState(null);
    const [preview, setPreview]       = useState(user?.avatar || null);
    const [processing, setProcessing] = useState(false);
    const [errors, setErrors]         = useState({});
    const fileInputRef = useRef(null);

    const handleImageChange = (e) => {
        const file = e.target.files[0];
        if (!file) return;
        if (file.size > 5 * 1024 * 1024) {
            setErrors(p => ({ ...p, avatar: 'Image must be smaller than 5MB.' }));
            return;
        }
        setErrors(p => { const n = { ...p }; delete n.avatar; return n; });
        setAvatarFile(file);
        setPreview(URL.createObjectURL(file));
    };

    const submit = (e) => {
        e.preventDefault();
        setProcessing(true);
        setErrors({});

        // Build a real FormData object
        const fd = new FormData();
        fd.append('name', name);
        fd.append('username', username);
        fd.append('bio', bio || '');
        if (avatarFile) fd.append('avatar', avatarFile);

        // router.post with forceFormData: true — Inertia handles CSRF automatically
        router.post('/profile/update', fd, {
            forceFormData: true,
            onError: (errs) => { setErrors(errs); setProcessing(false); },
            onFinish: () => setProcessing(false),
        });
    };

    return (
        <AppLayout>
            <Head title="Edit profile" />
            <div className="p-6 md:p-10 max-w-3xl mx-auto w-full pb-24 md:pb-6">

                <div className="flex items-center space-x-4 mb-10">
                    <Link href="/profile" className="p-2 hover:bg-gray-800 rounded-full transition">
                        <ChevronLeft size={24} />
                    </Link>
                    <h1 className="text-2xl font-black italic">Edit profile</h1>
                </div>

                {errors.general && (
                    <div className="mb-6 bg-red-500/10 border border-red-400/30 rounded-2xl px-4 py-3 text-red-400 text-sm font-bold">
                        {errors.general}
                    </div>
                )}

                <form onSubmit={submit} className="space-y-10">
                    {/* Avatar */}
                    <div className="flex flex-col items-center space-y-3">
                        <div
                            className="relative group cursor-pointer"
                            onClick={() => fileInputRef.current?.click()}
                        >
                            <div className="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-900 bg-gray-800 flex items-center justify-center text-4xl font-bold relative">
                                {preview
                                    ? <img src={preview} className="w-full h-full object-cover" alt="avatar" />
                                    : <span>{name[0]?.toUpperCase() || 'U'}</span>
                                }
                                <div className="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition rounded-full">
                                    <Camera className="text-white" size={30} />
                                </div>
                            </div>
                        </div>
                        <input ref={fileInputRef} type="file" className="hidden" onChange={handleImageChange} accept="image/*" />
                        <p className="text-[11px] font-bold text-gray-500 uppercase tracking-widest">
                            Tap to change photo · max 5 MB
                        </p>
                        {errors.avatar && <p className="text-red-400 text-xs font-black">{errors.avatar}</p>}
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div className="space-y-2">
                            <label className="text-sm font-bold text-gray-400 pl-1 uppercase">Name</label>
                            <div className="relative">
                                <User className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500" size={18} />
                                <input type="text" value={name} onChange={e => setName(e.target.value)}
                                    className="w-full bg-gray-900 border border-white/5 rounded-2xl py-4 pl-12 pr-4 focus:ring-2 focus:ring-primary outline-none transition"
                                    placeholder="Your name" required />
                            </div>
                            {errors.name && <p className="text-red-500 text-xs">{errors.name}</p>}
                        </div>

                        <div className="space-y-2">
                            <label className="text-sm font-bold text-gray-400 pl-1 uppercase">Username</label>
                            <div className="relative">
                                <AtSign className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500" size={18} />
                                <input type="text" value={username} onChange={e => setUsername(e.target.value)}
                                    className="w-full bg-gray-900 border border-white/5 rounded-2xl py-4 pl-12 pr-4 focus:ring-2 focus:ring-primary outline-none transition"
                                    placeholder="username" required />
                            </div>
                            {errors.username && <p className="text-red-500 text-xs">{errors.username}</p>}
                        </div>
                    </div>

                    <div className="space-y-2">
                        <label className="text-sm font-bold text-gray-400 pl-1 uppercase">Bio</label>
                        <div className="relative">
                            <FileText className="absolute left-4 top-5 text-gray-500" size={18} />
                            <textarea value={bio} onChange={e => setBio(e.target.value)} maxLength={80}
                                className="w-full bg-gray-900 border border-white/5 rounded-2xl py-4 pl-12 pr-4 focus:ring-2 focus:ring-primary outline-none transition min-h-[120px] resize-none"
                                placeholder="Tell the world about yourself..." />
                        </div>
                        <div className="flex justify-end pr-2 text-[10px] text-gray-500 font-bold uppercase tracking-widest">{bio.length} / 80</div>
                    </div>

                    <div className="flex space-x-4 pt-6">
                        <Link href="/profile" className="flex-1 bg-gray-800 text-white font-bold py-4 rounded-2xl text-center hover:bg-gray-700 transition">
                            Cancel
                        </Link>
                        <button type="submit" disabled={processing}
                            className="flex-1 bg-primary text-black font-black py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition disabled:opacity-50">
                            {processing ? 'Saving…' : 'Save Changes'}
                        </button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
