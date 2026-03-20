import React from 'react';
import AppLayout from '../Components/AppLayout';
import { Head } from '@inertiajs/react';
import { Upload as UploadIcon, Video, Music } from 'lucide-react';

export default function Upload() {
    return (
        <AppLayout>
            <Head title="Upload" />
            <div className="p-6 max-w-5xl mx-auto h-full flex items-center justify-center pb-24 md:pb-6">
                <div className="bg-gray-900 border-2 border-dashed border-gray-700 rounded-2xl p-10 flex flex-col items-center text-center space-y-6 w-full max-w-2xl cursor-pointer hover:bg-gray-800/50 transition duration-300 group">
                    <div className="bg-gray-800 rounded-full p-6 group-hover:bg-primary/20 transition duration-300">
                        <UploadIcon className="w-12 h-12 text-gray-400 group-hover:text-primary" />
                    </div>
                    <div>
                        <h2 className="text-xl font-bold">Select video to upload</h2>
                        <p className="text-gray-500 mt-2">Or drag and drop a file</p>
                    </div>

                    <div className="grid grid-cols-2 gap-4 w-full pt-6 text-sm text-gray-400 font-semibold">
                        <div className="flex items-center space-x-2 justify-center bg-gray-800/40 p-3 rounded-lg">
                            <Video size={16} />
                            <span>MP4 or WebM</span>
                        </div>
                        <div className="flex items-center space-x-2 justify-center bg-gray-800/40 p-3 rounded-lg">
                            <Music size={16} />
                            <span>720x1280 or higher</span>
                        </div>
                    </div>

                    <button className="bg-primary text-black font-black px-12 py-3 rounded-md shadow-lg shadow-primary/20 hover:bg-primary/90 transition transform hover:scale-105">
                        Select file
                    </button>

                    <p className="text-[12px] text-gray-500 max-w-md">
                        By submitting your videos to AmazamaHub, you acknowledge that you agree to our Terms of Service and Community Guidelines.
                    </p>
                </div>
            </div>
        </AppLayout>
    );
}
