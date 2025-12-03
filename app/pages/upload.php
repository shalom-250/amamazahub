<div class="flex flex-col">
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TikTok-Style Upload Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet">
    <style>
        .upload-area {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
        }
        .upload-area.dragover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }
        .progress-bar {
            transition: width 0.3s ease;
        }
        .video-preview {
            max-height: 400px;
            border-radius: 8px;
        }
        .hashtag {
            display: inline-block;
            background-color: #eff6ff;
            padding: 4px 8px;
            border-radius: 16px;
            margin-right: 8px;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .hashtag i {
            cursor: pointer;
            margin-left: 4px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-music text-pink-500 text-2xl mr-2"></i>
                <span class="text-xl font-bold">TikTok Clone</span>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-bell text-xl"></i>
                </button>
                <div class="relative">
                    <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=User&background=random" alt="User">
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800">Upload Video</h1>
                <p class="text-gray-600 mt-1">Share your content with the world</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Upload Area -->
                    <div>
                        <div id="uploadArea" class="upload-area rounded-lg p-8 text-center cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Select video to upload</h3>
                            <p class="text-gray-500 mb-4">Or drag and drop a file</p>
                            <p class="text-sm text-gray-400 mb-6">MP4 or WebM, up to 10 minutes, 500MB</p>
                            <button id="selectFileBtn" class="bg-pink-500 hover:bg-pink-600 text-white font-medium py-2 px-6 rounded-full transition duration-200">
                                Select File
                            </button>
                            <input type="file" id="fileInput" class="hidden" accept="video/*">
                        </div>

                        <!-- Upload Progress -->
                        <div id="uploadProgress" class="mt-6 hidden">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Uploading...</span>
                                <span id="progressPercent">0%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div id="progressBar" class="bg-pink-500 h-2.5 rounded-full progress-bar" style="width: 0%"></div>
                            </div>
                        </div>

                        <!-- Video Preview -->
                        <div id="videoPreview" class="mt-6 hidden">
                            <video id="previewVideo" class="video-preview w-full" controls>
                                Your browser does not support the video tag.
                            </video>
                            <div class="flex justify-center mt-4 space-x-4">
                                <button id="replaceVideoBtn" class="text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-redo-alt mr-1"></i> Replace
                                </button>
                                <button id="deleteVideoBtn" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Video Details -->
                    <div>
                        <div class="mb-6">
                            <label for="caption" class="block mb-2 text-sm font-medium text-gray-700">Caption</label>
                            <textarea id="caption" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-500" placeholder="Write a caption..."></textarea>
                            <div class="flex justify-between mt-1">
                                <span class="text-xs text-gray-500">@username</span>
                                <span id="captionCount" class="text-xs text-gray-500">0/150</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Cover</label>
                            <div class="flex space-x-4 overflow-x-auto pb-2">
                                <div class="flex-shrink-0 w-24 h-32 bg-gray-200 rounded-lg flex items-center justify-center cursor-pointer border-2 border-pink-500">
                                    <span class="text-xs text-pink-500 font-medium">Selected</span>
                                </div>
                                <div class="flex-shrink-0 w-24 h-32 bg-gray-200 rounded-lg flex items-center justify-center cursor-pointer">
                                    <i class="fas fa-plus text-gray-400"></i>
                                </div>
                                <div class="flex-shrink-0 w-24 h-32 bg-gray-200 rounded-lg flex items-center justify-center cursor-pointer">
                                    <i class="fas fa-plus text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Who can view this video</label>
                            <div class="flex space-x-4">
                                <div class="flex items-center">
                                    <input id="public" type="radio" value="public" name="visibility" class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500" checked>
                                    <label for="public" class="ml-2 text-sm font-medium text-gray-900">Public</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="friends" type="radio" value="friends" name="visibility" class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500">
                                    <label for="friends" class="ml-2 text-sm font-medium text-gray-900">Friends</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="private" type="radio" value="private" name="visibility" class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500">
                                    <label for="private" class="ml-2 text-sm font-medium text-gray-900">Private</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Allow</label>
                            <div class="flex items-center mb-4">
                                <input id="comments" type="checkbox" value="" class="w-4 h-4 text-pink-600 bg-gray-100 rounded border-gray-300 focus:ring-pink-500" checked>
                                <label for="comments" class="ml-2 text-sm font-medium text-gray-900">Comments</label>
                            </div>
                            <div class="flex items-center mb-4">
                                <input id="duet" type="checkbox" value="" class="w-4 h-4 text-pink-600 bg-gray-100 rounded border-gray-300 focus:ring-pink-500" checked>
                                <label for="duet" class="ml-2 text-sm font-medium text-gray-900">Duet</label>
                            </div>
                            <div class="flex items-center">
                                <input id="stitch" type="checkbox" value="" class="w-4 h-4 text-pink-600 bg-gray-100 rounded border-gray-300 focus:ring-pink-500" checked>
                                <label for="stitch" class="ml-2 text-sm font-medium text-gray-900">Stitch</label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="hashtags" class="block mb-2 text-sm font-medium text-gray-700">Hashtags</label>
                            <div class="flex">
                                <input type="text" id="hashtags" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5" placeholder="Add hashtags">
                                <button id="addHashtagBtn" class="bg-pink-500 hover:bg-pink-600 text-white font-medium py-2 px-4 rounded-r-lg transition duration-200">
                                    Add
                                </button>
                            </div>
                            <div id="hashtagContainer" class="mt-3 flex flex-wrap">
                                <!-- Hashtags will be added here dynamically -->
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                            <button class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-200">
                                Save as Draft
                            </button>
                            <button id="publishBtn" class="px-6 py-2.5 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-200">
                                Publish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadArea = document.getElementById('uploadArea');
            const fileInput = document.getElementById('fileInput');
            const selectFileBtn = document.getElementById('selectFileBtn');
            const uploadProgress = document.getElementById('uploadProgress');
            const progressBar = document.getElementById('progressBar');
            const progressPercent = document.getElementById('progressPercent');
            const videoPreview = document.getElementById('videoPreview');
            const previewVideo = document.getElementById('previewVideo');
            const replaceVideoBtn = document.getElementById('replaceVideoBtn');
            const deleteVideoBtn = document.getElementById('deleteVideoBtn');
            const caption = document.getElementById('caption');
            const captionCount = document.getElementById('captionCount');
            const hashtags = document.getElementById('hashtags');
            const addHashtagBtn = document.getElementById('addHashtagBtn');
            const hashtagContainer = document.getElementById('hashtagContainer');
            const publishBtn = document.getElementById('publishBtn');

            // File selection
            selectFileBtn.addEventListener('click', () => fileInput.click());
            
            fileInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    handleFileSelection(this.files[0]);
                }
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                uploadArea.classList.add('dragover');
            }

            function unhighlight() {
                uploadArea.classList.remove('dragover');
            }

            uploadArea.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files && files[0]) {
                    handleFileSelection(files[0]);
                }
            });

            // Handle file selection
            function handleFileSelection(file) {
                if (!file.type.match('video.*')) {
                    alert('Please select a video file');
                    return;
                }

                // Show upload progress (simulated)
                uploadProgress.classList.remove('hidden');
                simulateUploadProgress();

                // After "upload", show preview
                setTimeout(() => {
                    uploadProgress.classList.add('hidden');
                    videoPreview.classList.remove('hidden');
                    uploadArea.classList.add('hidden');
                    
                    const videoURL = URL.createObjectURL(file);
                    previewVideo.src = videoURL;
                }, 2000);
            }

            // Simulate upload progress
            function simulateUploadProgress() {
                let width = 0;
                const interval = setInterval(() => {
                    if (width >= 100) {
                        clearInterval(interval);
                    } else {
                        width += Math.random() * 10;
                        if (width > 100) width = 100;
                        progressBar.style.width = width + '%';
                        progressPercent.textContent = Math.round(width) + '%';
                    }
                }, 200);
            }

            // Replace video
            replaceVideoBtn.addEventListener('click', () => {
                fileInput.click();
            });

            // Delete video
            deleteVideoBtn.addEventListener('click', () => {
                videoPreview.classList.add('hidden');
                uploadArea.classList.remove('hidden');
                previewVideo.src = '';
                fileInput.value = '';
            });

            // Caption character count
            caption.addEventListener('input', function() {
                const count = this.value.length;
                captionCount.textContent = `${count}/150`;
                
                if (count > 150) {
                    captionCount.classList.add('text-red-500');
                } else {
                    captionCount.classList.remove('text-red-500');
                }
            });

            // Add hashtags
            addHashtagBtn.addEventListener('click', addHashtag);
            
            hashtags.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    addHashtag();
                }
            });

            function addHashtag() {
                const hashtagText = hashtags.value.trim();
                if (hashtagText && !hashtagText.startsWith('#')) {
                    const hashtagElement = document.createElement('div');
                    hashtagElement.className = 'hashtag';
                    hashtagElement.innerHTML = `#${hashtagText} <i class="fas fa-times text-gray-500 hover:text-gray-700"></i>`;
                    
                    hashtagElement.querySelector('i').addEventListener('click', function() {
                        hashtagElement.remove();
                    });
                    
                    hashtagContainer.appendChild(hashtagElement);
                    hashtags.value = '';
                }
            }

            // Publish button
            publishBtn.addEventListener('click', function() {
                if (!previewVideo.src) {
                    alert('Please select a video to upload');
                    return;
                }
                
                // Show success message
                alert('Your video has been published successfully!');
                
                // Reset form
                videoPreview.classList.add('hidden');
                uploadArea.classList.remove('hidden');
                previewVideo.src = '';
                fileInput.value = '';
                caption.value = '';
                captionCount.textContent = '0/150';
                hashtagContainer.innerHTML = '';
            });
        });
    </script>
</body>
</html>
</div>