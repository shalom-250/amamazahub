import React from 'react';
import { motion } from 'framer-motion';

export default function Watermark({ size = 'sm', className = '' }) {
    const isLarge = size === 'lg';

    return (
        <motion.div
            initial={{ opacity: 0.3, scale: 0.95 }}
            animate={{
                opacity: [0.2, 0.4, 0.2],
                scale: [0.95, 1, 0.95],
            }}
            transition={{
                duration: 5,
                repeat: Infinity,
                ease: "easeInOut"
            }}
            className={`absolute bottom-4 right-4 z-30 pointer-events-none select-none flex items-center space-x-1.5 bg-black/10 backdrop-blur-[1px] px-2 py-1 rounded-lg border border-white/5 ${className}`}
        >
            <div className={`${isLarge ? 'w-5 h-5' : 'w-3.5 h-3.5'} rounded-md overflow-hidden flex-shrink-0 opacity-40`}>
                <img src="/images/logo.png" className="w-full h-full object-cover" alt="logo" />
            </div>
            <div className="flex flex-col">
                <span className={`${isLarge ? 'text-xs' : 'text-[7px]'} font-extralight italic tracking-[0.2em] text-primary uppercase leading-none opacity-50`}>
                    AmazamaHub
                </span>
            </div>
        </motion.div>
    );
}
