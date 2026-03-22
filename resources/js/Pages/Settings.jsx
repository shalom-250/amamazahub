import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, Link, usePage, useForm } from '@inertiajs/react';
import { User, Lock, Bell, Shield, Wallet, CircleHelp, Info, LogOut, ChevronRight, Moon, Globe, EyeOff, Clock, BookOpen, Settings2 } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';

export default function Settings() {
    const { auth } = usePage().props;
    const { user } = auth;

    const { data, setData, post, processing } = useForm({
        language: user.language || 'en',
        dark_mode: user.dark_mode ?? true,
        push_notifications: user.push_notifications ?? true,
        location: user.location || 'Kigali',
    });

    const updateSetting = (key, value) => {
        const newData = { ...data, [key]: value };
        setData(key, value);
        post('/settings/update', {
            preserveScroll: true,
            data: newData
        });
    };

    const cities = ['Kigali', 'Musanze', 'Butare', 'Gisenyi', 'Kibuye', 'Gitarama'];

    const sections = [
        {
            title: 'Account',
            items: [
                { icon: <User size={20} />, label: 'Edit profile', href: '/profile/edit' },
                {
                    icon: <Globe size={20} />,
                    label: 'Language',
                    detail: data.language === 'en' ? 'English' : 'Kinyarwanda',
                    onClick: () => updateSetting('language', data.language === 'en' ? 'rw' : 'en')
                },
                {
                    icon: <Globe size={20} />,
                    label: 'Location',
                    detail: data.location,
                    onClick: () => {
                        const currentIndex = cities.indexOf(data.location);
                        const nextIndex = (currentIndex + 1) % cities.length;
                        updateSetting('location', cities[nextIndex]);
                    }
                },
                { icon: <Wallet size={20} />, label: 'Balance', detail: `${user.balance || 0} Coins`, href: '/wallet' },
            ]
        },
        {
            title: 'Privacy & Safety',
            items: [
                { icon: <Lock size={20} />, label: 'Privacy Center', href: '/privacy' },
                { icon: <Shield size={20} />, label: 'Safety Center', href: '/safety' },
                { icon: <BookOpen size={20} />, label: 'Community Guidelines', href: '/guidelines' },
            ]
        },
        {
            title: 'Content & Activity',
            items: [
                { icon: <Clock size={20} />, label: 'Watch History', href: '/activity' },
                { icon: <Settings2 size={20} />, label: 'Content Preferences', href: '/preferences' },
                {
                    icon: <Bell size={20} />,
                    label: 'Push notifications',
                    toggle: true,
                    active: data.push_notifications,
                    onClick: () => updateSetting('push_notifications', !data.push_notifications)
                },
                {
                    icon: <Moon size={20} />,
                    label: 'Dark mode',
                    detail: data.dark_mode ? 'On' : 'Off',
                    toggle: true,
                    active: data.dark_mode,
                    onClick: () => updateSetting('dark_mode', !data.dark_mode)
                },
            ]
        },
        {
            title: 'Support',
            items: [
                { icon: <CircleHelp size={20} />, label: 'Help Center', href: '/help' },
                { icon: <Info size={20} />, label: 'Terms of Service' },
            ]
        }
    ];

    return (
        <AppLayout>
            <Head title="Settings - AmazamaHub" />

            <div className="max-w-2xl mx-auto w-full py-8 px-4 pb-24 md:pb-8">
                <div className="flex items-center space-x-4 mb-8 px-2">
                    <div className="p-3 bg-primary/10 rounded-2xl text-primary">
                        <Settings2 size={24} />
                    </div>
                    <h1 className="text-2xl font-black italic tracking-tighter uppercase">Settings and privacy</h1>
                </div>

                <div className="space-y-8">
                    {sections.map((section, idx) => (
                        <div key={idx} className="space-y-2">
                            <p className="text-[10px] text-gray-500 font-black uppercase tracking-[0.2em] px-4">{section.title}</p>
                            <div className="bg-gray-900/10 backdrop-blur-xl rounded-3xl border border-white/5 overflow-hidden">
                                {section.items.map((item, i) => (
                                    <div key={i} className="border-b border-white/5 last:border-0">
                                        {item.href ? (
                                            <Link
                                                href={item.href}
                                                className="flex items-center justify-between p-4 hover:bg-white/5 transition group"
                                            >
                                                <div className="flex items-center space-x-4">
                                                    <div className="text-gray-400 group-hover:text-primary transition">
                                                        {item.icon}
                                                    </div>
                                                    <span className="text-sm font-semibold text-gray-200">{item.label}</span>
                                                </div>
                                                <div className="flex items-center space-x-2">
                                                    {item.detail && <span className="text-xs font-bold text-gray-500 italic">{item.detail}</span>}
                                                    <ChevronRight size={18} className="text-gray-700 group-hover:text-gray-500 transition" />
                                                </div>
                                            </Link>
                                        ) : (
                                            <button
                                                onClick={item.onClick}
                                                disabled={processing}
                                                className="w-full flex items-center justify-between p-4 hover:bg-white/5 transition group text-left"
                                            >
                                                <div className="flex items-center space-x-4">
                                                    <div className="text-gray-400 group-hover:text-primary transition">
                                                        {item.icon}
                                                    </div>
                                                    <span className="text-sm font-semibold text-gray-200">{item.label}</span>
                                                </div>
                                                <div className="flex items-center space-x-2">
                                                    {item.detail && <span className="text-xs font-bold text-gray-500 italic">{item.detail}</span>}
                                                    {item.toggle && (
                                                        <div className={`w-10 h-6 rounded-full relative transition-colors duration-300 ${item.active ? 'bg-primary' : 'bg-gray-800'}`}>
                                                            <motion.div
                                                                animate={{ x: item.active ? 16 : 4 }}
                                                                className="absolute top-1 w-4 h-4 bg-white rounded-full shadow-lg"
                                                            ></motion.div>
                                                        </div>
                                                    )}
                                                    {!item.toggle && <ChevronRight size={18} className="text-gray-700 group-hover:text-gray-500 transition" />}
                                                </div>
                                            </button>
                                        )}
                                    </div>
                                ))}
                            </div>
                        </div>
                    ))}

                    <div className="pt-6">
                        <Link
                            method="post"
                            as="button"
                            href="/logout"
                            className="w-full flex items-center justify-center space-x-2 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-2xl font-black italic hover:bg-red-500/20 transition"
                        >
                            <LogOut size={20} />
                            <span>Log out</span>
                        </Link>
                        <p className="text-center text-[10px] text-gray-600 font-black uppercase mt-10 tracking-widest leading-loose">
                            AmazamaHub v1.0.4<br />
                            Created with ❤️ for Creators
                        </p>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
