import React, { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';

export default function Watermark({ size = 'sm', className = '' }) {
    const isLarge = size === 'lg';

    const positions = [
        'bottom-6 right-6',
        'top-6 left-6',
        'top-6 right-6',
        'bottom-6 left-6'
    ];

    const [corner, setCorner] = useState(0);

    useEffect(() => {
        const interval = setInterval(() => {
            setCorner(prev => (prev + 1) % 4);
        }, 7000);
        return () => clearInterval(interval);
    }, []);

    return (
        <AnimatePresence mode="wait">
            <motion.div
                key={corner}
                initial={{ opacity: 0, scale: 0.9 }}
                animate={{
                    opacity: 0.9,
                    scale: 1,
                    y: [0, -6, 0], // floating
                }}
                exit={{ opacity: 0, scale: 0.8 }}
                transition={{
                    opacity: { duration: 1 },
                    scale: { duration: 1 },
                    y: {
                        duration: 3,
                        repeat: Infinity,
                        ease: "easeInOut"
                    }
                }}
                className={`absolute z-30 pointer-events-none select-none ${positions[corner]} ${className}`}
            >
                <span
                    className={`
                        ${isLarge ? 'text-sm' : 'text-xs'} 
                        font-light tracking-[0.3em] uppercase
                        text-[#ed7014]
                        drop-shadow-[0_0_6px_rgba(237,112,20,0.6)]
                    `}
                >
                    AMAZAMAHUB
                </span>
            </motion.div>
        </AnimatePresence>
    );
}