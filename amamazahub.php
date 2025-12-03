<?php include "app/pages/sections/h.php";?>
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
<!-- <script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script> -->
  <!-- MAIN CONTENT -->
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TikTok Style Modal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        .category-btn {
            transition: all 0.2s ease;
        }
        .category-btn:hover {
            transform: translateY(-2px);
        }
        .category-btn.selected {
            background-color: #000;
            color: #fff;
        }
        .dark .category-btn.selected {
            background-color: #fff;
            color: #000;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">
    <!-- Modal toggle -->
    <button data-modal-target="tiktok-modal" data-modal-toggle="tiktok-modal" class="block text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:focus:ring-purple-800">
        Open TikTok Modal
    </button>

    <!-- TikTok Modal -->
    <div id="tiktok-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-2xl shadow-lg dark:bg-gray-800 overflow-hidden">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        What would you like to watch on TikTok?
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="tiktok-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                
                <!-- Modal body -->
                <div class="p-5">
                    <!-- Category grid -->
                    <div class="grid grid-cols-3 gap-3 mb-6">
                        <button class="category-btn bg-gray-100 dark:bg-gray-700 rounded-xl p-3 flex flex-col items-center justify-center h-24">
                            <i class="fas fa-paw text-xl mb-2"></i>
                            <span class="text-sm font-medium">Animals</span>
                        </button>
                        <button class="category-btn bg-gray-100 dark:bg-gray-700 rounded-xl p-3 flex flex-col items-center justify-center h-24">
                            <i class="fas fa-laugh-squint text-xl mb-2"></i>
                            <span class="text-sm font-medium">Comedy</span>
                        </button>
                        <button class="category-btn bg-gray-100 dark:bg-gray-700 rounded-xl p-3 flex flex-col items-center justify-center h-24">
                            <i class="fas fa-plane text-xl mb-2"></i>
                            <span class="text-sm font-medium">Travel</span>
                        </button>
                        <button class="category-btn bg-gray-100 dark:bg-gray-700 rounded-xl p-3 flex flex-col items-center justify-center h-24">
                            <i class="fas fa-utensils text-xl mb-2"></i>
                            <span class="text-sm font-medium">Food</span>
                        </button>
                        <button class="category-btn bg-gray-100 dark:bg-gray-700 rounded-xl p-3 flex flex-col items-center justify-center h-24">
                            <i class="fas fa-basketball-ball text-xl mb-2"></i>
                            <span class="text-sm font-medium">Sports</span>
                        </button>
                        <button class="category-btn bg-gray-100 dark:bg-gray-700 rounded-xl p-3 flex flex-col items-center justify-center h-24">
                            <i class="fas fa-palette text-xl mb-2"></i>
                            <span class="text-sm font-medium">Art</span>
                        </button>
                        <button class="category-btn bg-gray-100 dark:bg-gray-700 rounded-xl p-3 flex flex-col items-center justify-center h-24">
                            <i class="fas fa-gamepad text-xl mb-2"></i>
                            <span class="text-sm font-medium">Gaming</span>
                        </button>
                        <button class="category-btn bg-gray-100 dark:bg-gray-700 rounded-xl p-3 flex flex-col items-center justify-center h-24">
                            <i class="fas fa-flask text-xl mb-2"></i>
                            <span class="text-sm font-medium">Science</span>
                        </button>
                        <button class="category-btn bg-gray-100 dark:bg-gray-700 rounded-xl p-3 flex flex-col items-center justify-center h-24">
                            <i class="fas fa-magic text-xl mb-2"></i>
                            <span class="text-sm font-medium">Beauty</span>
                        </button>
                    </div>
                    
                    <!-- Continue button -->
                    <div class="text-center mb-4">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Continue (3/3)</span>
                    </div>
                    
                    <!-- Login section -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Log in</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            By continuing with an account located in Rwanda, you agree to our 
                            <a href="#" class="text-blue-500 hover:underline">Terms of Service</a> 
                            and acknowledge that you have read our 
                            <a href="#" class="text-blue-500 hover:underline">Privacy Policy</a>.
                        </p>
                    </div>
                    
                    <!-- Action buttons -->
                    <div class="flex gap-3">
                        <button class="flex-1 py-3 px-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-xl font-medium">
                            Maybe Later
                        </button>
                        <button class="flex-1 py-3 px-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-medium">
                            Log In
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get all modal toggles
            const modalToggles = document.querySelectorAll('[data-modal-toggle]');
            
            modalToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const target = this.getAttribute('data-modal-target');
                    const modal = document.getElementById(target);
                    
                    if (modal) {
                        modal.classList.toggle('hidden');
                    }
                });
            });
            
            // Close modal when clicking outside
            const modals = document.querySelectorAll('[id$="-modal"]');
            
            modals.forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                    }
                });
            });
            
            // Category selection
            const categoryButtons = document.querySelectorAll('.category-btn');
            
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Toggle selection
                    this.classList.toggle('selected');
                    
                    // Update icon color if selected
                    const icon = this.querySelector('i');
                    if (this.classList.contains('selected')) {
                        icon.classList.add('text-white');
                        icon.classList.remove('text-gray-700', 'dark:text-gray-300');
                    } else {
                        icon.classList.remove('text-white');
                        icon.classList.add('text-gray-700', 'dark:text-gray-300');
                    }
                });
            });
        });
    </script>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TikTok Login Modal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        .login-option {
            transition: all 0.2s ease;
        }
        .login-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .qr-code-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">
    <!-- Modal toggle -->
    <button data-modal-target="tiktok-login-modal" data-modal-toggle="tiktok-login-modal" class="block text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:focus:ring-purple-800">
        Open TikTok Login
    </button>

    <!-- TikTok Login Modal -->
    <div id="tiktok-login-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-2xl shadow-xl dark:bg-gray-800 overflow-hidden">
                <!-- Modal header -->
                <div class="flex items-center justify-center p-5 border-b dark:border-gray-700 relative">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white text-center">
                        Log in to TikTok
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm h-8 w-8 absolute right-4 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="tiktok-login-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                
                <!-- Modal body -->
                <div class="p-5">
                    <!-- QR Code Option -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 text-center">Use QR code</h4>
                        <div class="qr-code-container rounded-xl p-6 flex flex-col items-center justify-center mb-4">
                            <div class="bg-white p-4 rounded-lg mb-4">
                                <!-- QR Code Placeholder -->
                                <div class="w-40 h-40 bg-gray-200 flex items-center justify-center rounded">
                                    <div class="text-center">
                                        <i class="fas fa-qrcode text-4xl text-gray-500 mb-2"></i>
                                        <p class="text-xs text-gray-600">QR Code</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-white text-sm text-center">Scan with TikTok app to log in</p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="flex items-center my-6">
                        <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
                        <span class="mx-4 text-gray-500 dark:text-gray-400 text-sm">or</span>
                        <div class="flex-grow border-t border-gray-300 dark:border-gray-600"></div>
                    </div>

                    <!-- Login Options -->
                    <div class="space-y-3 mb-6">
                        <!-- Phone/Email/Username -->
                        <button class="login-option w-full py-3 px-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-medium flex items-center justify-center">
                            <i class="fas fa-mobile-alt mr-2"></i>
                            Use phone / email / username
                        </button>
                        
                        <!-- Facebook -->
                        <button class="login-option w-full py-3 px-4 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl font-medium flex items-center justify-center">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            Continue with Facebook
                        </button>
                        
                        <!-- Google -->
                        <button class="login-option w-full py-3 px-4 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl font-medium flex items-center justify-center">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            Continue with Google
                        </button>
                        
                        <!-- Apple -->
                        <button class="login-option w-full py-3 px-4 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl font-medium flex items-center justify-center">
                            <i class="fab fa-apple mr-2"></i>
                            Continue with Apple
                        </button>
                    </div>

                    <!-- Last Login Section -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-900 dark:text-white mb-2">Last login</h4>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">username123</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Last login: 2 days ago</p>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Privacy -->
                    <div class="text-center mb-6">
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            By continuing with an account located in Rwanda, you agree to our 
                            <a href="#" class="text-blue-500 hover:underline">Terms of Service</a> 
                            and acknowledge that you have read our 
                            <a href="#" class="text-blue-500 hover:underline">Privacy Policy</a>.
                        </p>
                    </div>

                    <!-- Sign Up Link -->
                    <div class="text-center border-t border-gray-200 dark:border-gray-700 pt-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Don't have an account? 
                            <a href="#" class="font-medium text-purple-600 dark:text-purple-400 hover:underline">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get all modal toggles
            const modalToggles = document.querySelectorAll('[data-modal-toggle]');
            
            modalToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const target = this.getAttribute('data-modal-target');
                    const modal = document.getElementById(target);
                    
                    if (modal) {
                        modal.classList.toggle('hidden');
                    }
                });
            });
            
            // Close modal when clicking outside
            const modals = document.querySelectorAll('[id$="-modal"]');
            
            modals.forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                    }
                });
            });
            
            // Login option buttons functionality
            const loginOptions = document.querySelectorAll('.login-option');
            
            loginOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // In a real app, this would trigger the respective login flow
                    alert(`Login with ${this.textContent.trim()} selected`);
                });
            });
        });
    </script>
</body>
</html>
  <main class="flex-1 flex  md:items-start md:justify-center p-0 md:p-4"  id="content" >
    <!-- contents -->
  </main>
<script>
 async function loadPage(url){
      try {
          const response = await axios.get(`app/pages/${url}.php`);
          // alert(response.data);
          $("#content").html(response.data);
          window.history.pushState(null,null,url);
      } catch (error) {
        showMessage(`Error:${error}`);
      }
  }
  loadPage('home');
</script>

<?php include "app/pages/sections/f.php";?>