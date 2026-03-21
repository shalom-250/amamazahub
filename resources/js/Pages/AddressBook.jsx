import React, { useState } from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, Link, router } from '@inertiajs/react';
import { MapPin, Plus, Home, Briefcase, Trash2, Edit2, ChevronRight, Check, X } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';

export default function AddressBook({ addresses }) {
    const [isAdding, setIsAdding] = useState(false);
    const [form, setForm] = useState({
        type: 'Home',
        name: '',
        phone: '',
        address: ''
    });

    const submit = (e) => {
        e.preventDefault();
        router.post('/shop/addresses', form, {
            onSuccess: () => {
                setIsAdding(false);
                setForm({ type: 'Home', name: '', phone: '', address: '' });
            }
        });
    };

    const setDefault = (id) => {
        router.put(`/shop/addresses/${id}/default`);
    };

    const removeAddress = (id) => {
        if (confirm('Are you sure you want to delete this address?')) {
            router.delete(`/shop/addresses/${id}`);
        }
    };

    return (
        <AppLayout>
            <Head title="Address Book - AmazamaShop" />

            <div className="max-w-2xl mx-auto w-full py-8 px-4 pb-24 md:pb-8">
                <div className="flex items-center justify-between mb-10">
                    <h1 className="text-2xl font-black italic tracking-tighter">Shipping Addresses</h1>
                    <button onClick={() => setIsAdding(!isAdding)} className="p-2 bg-primary/10 border border-primary/20 rounded-full text-primary hover:bg-primary/20 transition">
                        {isAdding ? <X size={22} /> : <Plus size={22} />}
                    </button>
                </div>

                <AnimatePresence>
                    {isAdding && (
                        <motion.div initial={{ opacity: 0, height: 0 }} animate={{ opacity: 1, height: 'auto' }} exit={{ opacity: 0, height: 0 }} className="mb-8 p-6 bg-gray-900 border border-gray-800 rounded-3xl">
                            <h2 className="text-sm font-black italic uppercase tracking-widest text-gray-400 mb-4">Add New Address</h2>
                            <form onSubmit={submit} className="space-y-4">
                                <div className="grid grid-cols-2 gap-4">
                                    <input required type="text" placeholder="Full Name" value={form.name} onChange={e => setForm({ ...form, name: e.target.value })} className="bg-black border border-gray-800 rounded-xl p-3 text-sm focus:border-primary transition" />
                                    <input required type="text" placeholder="Phone Number" value={form.phone} onChange={e => setForm({ ...form, phone: e.target.value })} className="bg-black border border-gray-800 rounded-xl p-3 text-sm focus:border-primary transition" />
                                </div>
                                <div className="flex space-x-4">
                                    <label className="flex items-center space-x-2 bg-black px-4 py-2 border border-gray-800 rounded-xl cursor-pointer">
                                        <input type="radio" value="Home" checked={form.type === 'Home'} onChange={e => setForm({ ...form, type: 'Home' })} className="accent-primary" />
                                        <span className="text-xs font-bold text-gray-300">Home</span>
                                    </label>
                                    <label className="flex items-center space-x-2 bg-black px-4 py-2 border border-gray-800 rounded-xl cursor-pointer">
                                        <input type="radio" value="Work" checked={form.type === 'Work'} onChange={e => setForm({ ...form, type: 'Work' })} className="accent-primary" />
                                        <span className="text-xs font-bold text-gray-300">Work</span>
                                    </label>
                                </div>
                                <textarea required placeholder="Full Address (Street, City, Zip, Country)" value={form.address} onChange={e => setForm({ ...form, address: e.target.value })} className="w-full h-24 bg-black border border-gray-800 rounded-xl p-3 text-sm focus:border-primary transition resize-none"></textarea>
                                <button type="submit" className="w-full bg-primary text-black font-black italic py-3 rounded-xl hover:brightness-110 transition">Save Address</button>
                            </form>
                        </motion.div>
                    )}
                </AnimatePresence>

                <div className="space-y-6">
                    {addresses.length === 0 && !isAdding && (
                        <div className="text-center py-10 bg-gray-900/20 rounded-3xl border border-gray-800">
                            <p className="text-gray-500 font-bold">No addresses found.</p>
                        </div>
                    )}
                    {addresses.map((addr) => (
                        <div key={addr.id} className={`bg-gray-900/20 border ${addr.isDefault ? 'border-primary/50' : 'border-gray-900'} rounded-[32px] p-8 space-y-4 relative overflow-hidden group transition`}>
                            <div className="flex items-center justify-between">
                                <div className="flex items-center space-x-3">
                                    <div className={`p-2 rounded-xl ${addr.isDefault ? 'bg-primary/20 text-primary' : 'bg-gray-800 text-gray-500'}`}>
                                        {addr.type === 'Home' ? <Home size={18} /> : <Briefcase size={18} />}
                                    </div>
                                    <span className="text-sm font-black italic uppercase tracking-widest">{addr.type}</span>
                                    {addr.isDefault && <span className="text-[8px] font-black uppercase tracking-tighter bg-primary text-black px-2 py-0.5 rounded ml-2">Default</span>}
                                </div>
                                <div className="flex space-x-4 opacity-0 group-hover:opacity-100 transition duration-300">
                                    {!addr.isDefault && <button onClick={() => removeAddress(addr.id)} className="text-gray-500 hover:text-red-500 transition"><Trash2 size={16} /></button>}
                                </div>
                            </div>

                            <div className="space-y-2 pt-2">
                                <p className="font-bold text-gray-200">{addr.name}</p>
                                <p className="text-xs text-gray-500 font-medium">{addr.phone}</p>
                                <p className="text-xs text-gray-400 font-medium leading-relaxed">{addr.address}</p>
                            </div>

                            {!addr.isDefault && (
                                <button onClick={() => setDefault(addr.id)} className="w-full mt-4 py-3 bg-gray-900 rounded-2xl text-[10px] font-black uppercase tracking-widest text-gray-600 hover:bg-gray-800 hover:text-white transition">
                                    Set as Default
                                </button>
                            )}
                        </div>
                    ))}
                </div>

                <div className="mt-12 p-8 bg-gray-950/40 border border-gray-900 rounded-[40px] flex items-start space-x-4">
                    <div className="p-3 bg-blue-500/10 rounded-2xl text-blue-400"><MapPin size={24} /></div>
                    <div className="space-y-1">
                        <p className="text-[10px] font-black italic tracking-widest uppercase text-gray-300">Privacy Notice</p>
                        <p className="text-[10px] text-gray-500 font-medium leading-relaxed">Your addresses are encrypted and used only for shipping purposes. We never share your personal details with third-party advertisers.</p>
                    </div>
                </div>
            </div>
        </AppLayout >
    );
}
