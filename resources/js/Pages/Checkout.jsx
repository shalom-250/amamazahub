import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head, Link } from '@inertiajs/react';
import { ShieldCheck, Truck, CreditCard, ChevronLeft, Lock, Info } from 'lucide-react';
import { motion } from 'framer-motion';

export default function Checkout({ defaultAddress, defaultPayment, cartItems = [], subtotal = 0, user }) {
    const parseFRW = (val) => parseFloat(String(val).replace(/[^0-9.]/g, '')) || 0;
    const totalFRW = Math.round(parseFRW(subtotal)).toLocaleString();

    return (
        <AppLayout>
            <Head title="Checkout - AmazamaShop" />

            <div className="max-w-5xl mx-auto w-full py-8 px-4 pb-24 md:pb-8">
                <Link href="/shop/cart" className="inline-flex items-center space-x-2 text-gray-500 hover:text-white mb-10 transition">
                    <ChevronLeft size={20} />
                    <span className="text-sm font-black italic">Return to Cart</span>
                </Link>

                <div className="flex flex-col lg:flex-row gap-12">
                    {/* Left: Checkout Process */}
                    <div className="flex-1 space-y-8">
                        {/* Shipping Section */}
                        <div className="bg-gray-900/20 border border-primary/20 rounded-[40px] p-8 shadow-2xl relative overflow-hidden">
                            <div className="flex items-center justify-between mb-6">
                                <div className="flex items-center space-x-3">
                                    <div className="bg-primary/20 p-2 rounded-xl text-primary"><Truck size={20} /></div>
                                    <h2 className="text-xl font-black italic">Shipping Address</h2>
                                </div>
                                <Link href="/shop/addresses" className="text-[10px] font-black italic uppercase text-primary hover:underline">Change</Link>
                            </div>
                            <div className="px-1 space-y-1">
                                {defaultAddress ? (
                                    <>
                                        <p className="font-bold text-gray-200">{defaultAddress.name}</p>
                                        <p className="text-xs text-gray-500 font-medium">{defaultAddress.address}</p>
                                    </>
                                ) : (
                                    <>
                                        <p className="font-bold text-primary">No Address Selected</p>
                                        <Link href="/shop/addresses" className="text-xs text-gray-400 font-medium underline">Please add a shipping address first</Link>
                                    </>
                                )}
                            </div>
                            <div className="absolute top-0 right-0 p-8 h-full flex flex-col justify-center translate-x-4 opacity-5 pointer-events-none">
                                <Truck size={100} />
                            </div>
                        </div>

                        {/* Payment Section */}
                        <div className="bg-gray-900/20 border border-gray-900 rounded-[40px] p-8">
                            <div className="flex items-center justify-between mb-6">
                                <div className="flex items-center space-x-3 text-gray-400">
                                    <div className="bg-gray-800 p-2 rounded-xl"><CreditCard size={20} /></div>
                                    <h2 className="text-xl font-black italic text-gray-200">Payment</h2>
                                </div>
                                <Link href="/shop/payments" className="text-[10px] font-black italic uppercase text-primary hover:underline">Edit</Link>
                            </div>
                            <div className="flex items-center justify-between p-5 bg-black/40 border border-gray-800 rounded-3xl">
                                {defaultPayment ? (
                                    <>
                                        <div className="flex items-center space-x-4">
                                            <div className={`w-12 h-8 ${defaultPayment.provider === 'MTN' ? 'bg-yellow-500 text-black' : 'bg-red-600 text-white'} rounded-lg flex items-center justify-center font-black italic text-[10px] tracking-widest shadow-lg`}>
                                                {defaultPayment.provider}
                                            </div>
                                            <div className="flex flex-col">
                                                <span className="text-sm font-bold text-gray-200">Mobile Money</span>
                                                <span className="text-[10px] text-gray-500 font-bold">{defaultPayment.phone_number}</span>
                                            </div>
                                        </div>
                                        <ShieldCheck size={18} className="text-green-400" />
                                    </>
                                ) : (
                                    <>
                                        <div className="flex flex-col space-y-1">
                                            <p className="font-bold text-primary">No Payment Method</p>
                                            <p className="text-xs text-gray-500 font-medium tracking-tighter">Please securely add a method.</p>
                                        </div>
                                        <Link href="/shop/payments" className="p-2 bg-primary/10 rounded-xl text-primary hover:bg-primary/20 transition"><ChevronLeft size={16} className="rotate-180" /></Link>
                                    </>
                                )}
                            </div>
                        </div>

                        {/* Items Preview */}
                        <div className="bg-gray-900/20 border border-gray-900 rounded-[40px] p-8">
                            <h2 className="text-sm font-black italic uppercase tracking-widest text-gray-400 mb-6">Review Items ({cartItems.length})</h2>
                            <div className="flex -space-x-4 overflow-x-auto pb-4 mb-2 noscrollbar">
                                {cartItems.map(item => (
                                    <div key={item.id} className="w-16 h-16 flex-shrink-0 rounded-2xl border-4 border-black/20 bg-gray-900 overflow-hidden relative group">
                                        <img src={item.product.image} className="w-full h-full object-cover group-hover:scale-110 transition duration-500" title={item.product.name} />
                                        {item.quantity > 1 && (
                                            <div className="absolute top-0 right-0 bg-primary text-black text-[8px] font-black italic px-1 rounded-bl">x{item.quantity}</div>
                                        )}
                                    </div>
                                ))}
                            </div>
                            <p className="text-[10px] text-gray-500 font-bold italic">Standard Delivery arriving in 3-5 days</p>
                        </div>
                    </div>

                    {/* Right: Summary & Pay */}
                    <div className="w-full lg:w-96 space-y-6">
                        <div className="bg-gray-900/40 border border-gray-800 p-8 rounded-[40px] space-y-8 sticky top-24 shadow-2xl">
                            <h3 className="text-xl font-black italic tracking-tighter flex items-center space-x-2">
                                <Lock size={18} className="text-primary" />
                                <span>Final Summary</span>
                            </h3>

                            <div className="space-y-4">
                                <div className="flex justify-between">
                                    <span className="text-[10px] font-black italic uppercase text-gray-500">Subtotal</span>
                                    <span className="font-bold italic">{totalFRW} FRW</span>
                                </div>
                                <div className="flex justify-between">
                                    <span className="text-[10px] font-black italic uppercase text-gray-500">Shipping</span>
                                    <span className="text-green-400 font-bold italic">0 FRW</span>
                                </div>
                                <div className="flex justify-between border-t border-gray-800 pt-4">
                                    <span className="text-sm font-black italic uppercase tracking-[0.2em]">Total</span>
                                    <span className="text-2xl font-black italic text-primary">{totalFRW} FRW</span>
                                </div>
                            </div>

                            <button className="w-full bg-primary text-black font-black italic py-5 rounded-3xl hover:scale-105 transition transform active:scale-95 shadow-xl shadow-primary/20 text-lg uppercase tracking-widest">
                                Complete Payment
                            </button>

                            <div className="flex items-start space-x-3 p-4 bg-primary/5 rounded-2xl border border-primary/10">
                                <Info size={16} className="text-primary mt-0.5" />
                                <p className="text-[9px] text-gray-400 leading-relaxed uppercase tracking-tighter">By completing your order, you agree to our Terms of Sale and Privacy Policy.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
