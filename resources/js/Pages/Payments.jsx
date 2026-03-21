import React, { useState } from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, Link, router } from '@inertiajs/react';
import { CreditCard, Wallet, Plus, ShieldCheck, ChevronRight, Check, X, Trash2 } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';

export default function Payments({ paymentMethods }) {
    const [isAdding, setIsAdding] = useState(false);
    const [form, setForm] = useState({ provider: 'MTN', phone_number: '' });

    const submit = (e) => {
        e.preventDefault();
        router.post('/shop/payments', form, {
            onSuccess: () => {
                setIsAdding(false);
                setForm({ provider: 'MTN', phone_number: '' });
            }
        });
    };

    const setDefault = (id) => {
        router.put(`/shop/payments/${id}/default`);
    };

    const removeMethod = (id) => {
        if (confirm('Are you sure you want to delete this payment method?')) {
            router.delete(`/shop/payments/${id}`);
        }
    };

    const getColors = (provider) => {
        if (provider === 'MTN') return 'from-yellow-400 to-yellow-600 text-black';
        if (provider === 'AIRTEL') return 'from-red-600 to-red-800 text-white';
        return 'from-gray-700 to-gray-900 text-white';
    };

    return (
        <AppLayout>
            <Head title="Payments - AmazamaShop" />

            <div className="max-w-2xl mx-auto w-full py-8 px-4 pb-24 md:pb-8">
                <div className="flex items-center justify-between mb-10">
                    <h1 className="text-2xl font-black italic tracking-tighter">Payment Methods</h1>
                    <button onClick={() => setIsAdding(!isAdding)} className="p-2 bg-primary/10 border border-primary/20 rounded-full text-primary hover:bg-primary/20 transition">
                        {isAdding ? <X size={22} /> : <Plus size={22} />}
                    </button>
                </div>

                <AnimatePresence>
                    {isAdding && (
                        <motion.div initial={{ opacity: 0, height: 0 }} animate={{ opacity: 1, height: 'auto' }} exit={{ opacity: 0, height: 0 }} className="mb-8 p-6 bg-gray-900 border border-gray-800 rounded-3xl">
                            <h2 className="text-sm font-black italic uppercase tracking-widest text-gray-400 mb-4">Add Mobile Money</h2>
                            <form onSubmit={submit} className="space-y-4">
                                <div className="flex space-x-4">
                                    <label className="flex items-center space-x-2 bg-black px-4 py-3 border border-gray-800 rounded-xl cursor-pointer w-full">
                                        <input type="radio" value="MTN" checked={form.provider === 'MTN'} onChange={e => setForm({ ...form, provider: 'MTN' })} className="accent-yellow-500" />
                                        <span className="text-sm font-black italic text-yellow-500">MTN Rwanda</span>
                                    </label>
                                    <label className="flex items-center space-x-2 bg-black px-4 py-3 border border-gray-800 rounded-xl cursor-pointer w-full">
                                        <input type="radio" value="AIRTEL" checked={form.provider === 'AIRTEL'} onChange={e => setForm({ ...form, provider: 'AIRTEL' })} className="accent-red-500" />
                                        <span className="text-sm font-black italic text-red-500">Airtel Money</span>
                                    </label>
                                </div>
                                <input required type="text" placeholder="Phone Number (e.g. 078... / 073...)" value={form.phone_number} onChange={e => setForm({ ...form, phone_number: e.target.value })} className="w-full bg-black border border-gray-800 rounded-xl p-4 text-sm focus:border-primary transition" />
                                <button type="submit" className="w-full bg-primary text-black font-black italic py-4 rounded-xl hover:brightness-110 transition">Save Payment Method</button>
                            </form>
                        </motion.div>
                    )}
                </AnimatePresence>

                <div className="space-y-6">
                    {paymentMethods.length === 0 && !isAdding && (
                        <div className="text-center py-10 bg-gray-900/20 rounded-3xl border border-gray-800">
                            <p className="text-gray-500 font-bold">No payment methods configured.</p>
                        </div>
                    )}
                    {paymentMethods.map((method) => (
                        <div key={method.id} className="relative group perspective-1000">
                            <div className={`bg-gradient-to-br ${getColors(method.provider)} rounded-[32px] p-8 h-48 flex flex-col justify-between shadow-2xl relative overflow-hidden transition-transform duration-500 group-hover:rotate-x-12`}>
                                <div className="flex justify-between items-start">
                                    <div className="flex flex-col">
                                        <p className={`text-[10px] font-black uppercase tracking-widest opacity-80 mb-1 ${method.provider === 'MTN' ? 'text-black' : 'text-white'}`}>Mobile Money</p>
                                        <div className="text-2xl font-black italic">{method.provider}</div>
                                    </div>
                                    <ShieldCheck className={`text-white ${method.provider === 'MTN' ? 'fill-black/10' : 'fill-white/10'}`} size={32} />
                                </div>
                                <div className="space-y-4 relative z-10">
                                    <div className="text-2xl font-black italic tracking-[0.2em]">{method.phone_number}</div>
                                    <div className="flex justify-between items-end">
                                        <div className="flex space-x-2">
                                            {method.isDefault && <span className="bg-black/20 px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest backdrop-blur-md">Default</span>}
                                        </div>
                                        <div className="flex space-x-3 opacity-0 group-hover:opacity-100 transition duration-300">
                                            {!method.isDefault && (
                                                <button onClick={() => setDefault(method.id)} className={`text-xs font-black uppercase tracking-widest hover:scale-105 transition ${method.provider === 'MTN' ? 'text-black/60 hover:text-black' : 'text-white/60 hover:text-white'}`}>Set Default</button>
                                            )}
                                            {!method.isDefault && <button onClick={() => removeMethod(method.id)} className="hover:scale-110 transition text-red-900"><Trash2 size={18} /></button>}
                                        </div>
                                    </div>
                                </div>
                                {/* Tech decor */}
                                <div className="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -mr-20 -mt-20 blur-2xl"></div>
                            </div>
                        </div>
                    ))}
                </div>

                <div className="mt-12 space-y-4">
                    <p className="text-[10px] text-gray-500 font-black italic uppercase tracking-widest px-4">Other Methods</p>
                    <div className="bg-gray-900/30 border border-gray-900 rounded-[32px] overflow-hidden">
                        {[
                            { title: 'Amazama Wallet', icon: <Wallet size={18} />, detail: 'Balance: $0.00' },
                            { title: 'PayPal', icon: <CreditCard size={18} />, detail: 'Link Account' },
                        ].map((method, i) => (
                            <div key={i} className="flex items-center justify-between p-6 hover:bg-white/5 transition border-b border-gray-900 last:border-0 cursor-pointer group">
                                <div className="flex items-center space-x-4">
                                    <div className="p-3 bg-gray-800 rounded-2xl text-gray-400 group-hover:text-primary transition">{method.icon}</div>
                                    <span className="text-sm font-bold text-gray-200">{method.title}</span>
                                </div>
                                <div className="flex items-center space-x-3">
                                    <span className="text-[10px] font-black italic text-gray-500">{method.detail}</span>
                                    <ChevronRight size={18} className="text-gray-800" />
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
