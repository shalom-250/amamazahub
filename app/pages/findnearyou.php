<div class="grid grid-cols-1">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nearby Finder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <style>
        .category-active {
            border-bottom: 3px solid #3b82f6;
            color: #3b82f6;
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header with Search -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <i class="fas fa-map-marker-alt text-blue-500 text-2xl mr-2"></i>
                    <h1 class="text-2xl font-bold text-gray-800">Nearby Finder</h1>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="relative">
                        <input type="text" placeholder="Search for jobs, shops, users, schools..." 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-4 mt-4 md:mt-0">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add Listing
                    </button>
                    <button class="p-2 text-gray-600 hover:text-blue-500">
                        <i class="fas fa-bell text-xl"></i>
                    </button>
                    <div class="relative">
                        <button class="flex items-center text-gray-700 hover:text-blue-500">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-blue-500"></i>
                            </div>
                            <span class="ml-2">John</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <!-- Categories Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Browse Categories</h2>
            <div class="flex overflow-x-auto pb-2 space-x-2 md:space-x-4">
                <button class="category-active flex-shrink-0 px-4 py-3 bg-white rounded-lg shadow-sm flex items-center">
                    <i class="fas fa-briefcase text-blue-500 mr-2"></i>
                    <span>Jobs</span>
                </button>
                <button class="flex-shrink-0 px-4 py-3 bg-white rounded-lg shadow-sm flex items-center">
                    <i class="fas fa-user text-green-500 mr-2"></i>
                    <span>Users</span>
                </button>
                <button class="flex-shrink-0 px-4 py-3 bg-white rounded-lg shadow-sm flex items-center">
                    <i class="fas fa-store text-purple-500 mr-2"></i>
                    <span>Shops</span>
                </button>
                <button class="flex-shrink-0 px-4 py-3 bg-white rounded-lg shadow-sm flex items-center">
                    <i class="fas fa-graduation-cap text-yellow-500 mr-2"></i>
                    <span>Schools</span>
                </button>
                <button class="flex-shrink-0 px-4 py-3 bg-white rounded-lg shadow-sm flex items-center">
                    <i class="fas fa-utensils text-red-500 mr-2"></i>
                    <span>Restaurants</span>
                </button>
                <button class="flex-shrink-0 px-4 py-3 bg-white rounded-lg shadow-sm flex items-center">
                    <i class="fas fa-home text-indigo-500 mr-2"></i>
                    <span>Real Estate</span>
                </button>
            </div>
        </section>

        <!-- Top 10 Section -->
        <section class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Top 10 Nearby Jobs</h2>
                <a href="#" class="text-blue-500 hover:text-blue-700 font-medium">View All</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Job Card 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-code text-blue-500 text-xl"></i>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Full-time</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Frontend Developer</h3>
                        <p class="text-gray-600 text-sm mb-3">Tech Solutions Inc.</p>
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>1.2 km away</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800">$85,000/yr</span>
                            <a href="/job/frontend-developer-tech-solutions" class="text-blue-500 hover:text-blue-700 font-medium">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Job Card 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-paint-brush text-purple-500 text-xl"></i>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Part-time</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">UI/UX Designer</h3>
                        <p class="text-gray-600 text-sm mb-3">Creative Studio</p>
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>0.8 km away</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800">$45/hr</span>
                            <a href="/job/ui-ux-designer-creative-studio" class="text-blue-500 hover:text-blue-700 font-medium">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Job Card 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-green-500 text-xl"></i>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Contract</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Marketing Manager</h3>
                        <p class="text-gray-600 text-sm mb-3">Growth Hackers</p>
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>2.1 km away</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800">$65,000/yr</span>
                            <a href="/job/marketing-manager-growth-hackers" class="text-blue-500 hover:text-blue-700 font-medium">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Job Card 4 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-laptop-code text-red-500 text-xl"></i>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Full-time</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Backend Developer</h3>
                        <p class="text-gray-600 text-sm mb-3">Data Systems Ltd.</p>
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>1.5 km away</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800">$95,000/yr</span>
                            <a href="/job/backend-developer-data-systems" class="text-blue-500 hover:text-blue-700 font-medium">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- All Listings Section -->
        <section>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">All Nearby Listings</h2>
                <div class="flex space-x-4">
                    <div class="flex items-center">
                        <span class="mr-2 text-gray-600">Sort by:</span>
                        <select class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Distance</option>
                            <option>Rating</option>
                            <option>Newest</option>
                        </select>
                    </div>
                    <button class="p-2 border border-gray-300 rounded-lg">
                        <i class="fas fa-filter text-gray-600"></i>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- User Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-blue-500 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-800">Sarah Johnson</h3>
                                <p class="text-gray-600 text-sm">Graphic Designer</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>0.5 km away</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-4">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="mr-2">4.8</span>
                            <span class="text-gray-400">|</span>
                            <span class="ml-2">12 reviews</span>
                        </div>
                        <a href="/user/sarah-johnson" class="block w-full text-center py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            View Profile
                        </a>
                    </div>
                </div>

                <!-- Shop Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-store text-purple-500 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-800">Green Grocers</h3>
                                <p class="text-gray-600 text-sm">Organic Food Store</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>1.1 km away</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-4">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="mr-2">4.5</span>
                            <span class="text-gray-400">|</span>
                            <span class="ml-2">24 reviews</span>
                        </div>
                        <a href="/shop/green-grocers" class="block w-full text-center py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            View Store
                        </a>
                    </div>
                </div>

                <!-- School Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <div class="p-5">
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-yellow-500 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-800">Westside High School</h3>
                                <p class="text-gray-600 text-sm">Public School</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>2.3 km away</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-4">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="mr-2">4.2</span>
                            <span class="text-gray-400">|</span>
                            <span class="ml-2">38 reviews</span>
                        </div>
                        <a href="/school/westside-high-school" class="block w-full text-center py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            View School
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Nearby Finder</h3>
                    <p class="text-gray-400">Find the best places and people near you. Connect with your local community.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Jobs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Users</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Shops</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Schools</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Subscribe</h3>
                    <p class="text-gray-400 mb-2">Get the latest updates</p>
                    <div class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-lg w-full text-gray-800 focus:outline-none">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition-colors">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2023 Nearby Finder. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 py-2 px-4 flex justify-between">
        <a href="#" class="flex flex-col items-center text-blue-500">
            <i class="fas fa-home text-lg"></i>
            <span class="text-xs mt-1">Home</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-500">
            <i class="fas fa-search text-lg"></i>
            <span class="text-xs mt-1">Search</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-500">
            <i class="fas fa-plus-circle text-lg"></i>
            <span class="text-xs mt-1">Add</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-500">
            <i class="fas fa-heart text-lg"></i>
            <span class="text-xs mt-1">Saved</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-500">
            <i class="fas fa-user text-lg"></i>
            <span class="text-xs mt-1">Profile</span>
        </a>
    </div>
</body>
</html>
</div>