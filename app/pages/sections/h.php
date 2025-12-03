<?php include_once "app/auth/isAuth.php";?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AMAMAZAHUB</title>

  <!-- Tailwind CSS + Flowbite -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"
    rel="stylesheet"
  />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- <script src="//unpkg.com/alpinejs" defer></script> -->


  <!-- Unicons (Line Icons) -->
  <link
    rel="stylesheet"
    href="https://unicons.iconscout.com/release/v4.0.8/css/line.css"
  />

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      transition: background-color 0.4s, color 0.4s;
    }
    .video {
      background: url('https://www.bigbuckbunny.org/') center/cover;
      border-radius: 1rem;
      position: relative;
    }
    .circle {
      border-radius: 50% !important;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>

</head>
<body class="bg-black text-white" >

<!-- Main container -->
<div class="flex flex-col md:flex-row min-h-screen">

  <!-- LEFT SIDEBAR -->
  <aside class="w-full md:w-64 bg-black border-r border-gray-800 p-4 flex flex-col justify-between hidden md:block">
    <div>
    	<div class="flex items-center space-x-2 text-lg font-bold mb-6">
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<!-- Uploaded to: SVG Repo, www.svgrepo.com, Transformed by: SVG Repo Mixer Tools -->
<svg fill="#e3e3e3" height="35px" width="35px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-29.49 -29.49 550.50 550.50" xml:space="preserve" stroke="#e3e3e3" transform="rotate(-45)" stroke-width="0.0049152">
<g id="SVGRepo_bgCarrier" stroke-width="0"/>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.9830399999999999"/>
<g id="SVGRepo_iconCarrier"> <g> <g> <path d="M263.213,465.658c-3.551,0-6.589-2.549-7.202-6.046l-10.522-59.871l-2.699-15.36h7.454c3.157,0,5.718-2.56,5.718-5.719 v-44.078c0-3.159-2.561-5.719-5.718-5.719h-17.209l-4.518-25.707h-74.723l32.124,182.815c0.564,3.207,3.35,5.547,6.606,5.547 h22.545h46.549h1.595c7.141,0,12.93-5.789,12.93-12.931C276.143,471.447,270.354,465.658,263.213,465.658z"/> </g> </g> <g> <g> <path d="M125.803,111.855l-32.967,11.39v14.682H61.893c-6.225,0-11.272,5.047-11.272,11.272v6.767H33.547 c-6.226,0-11.273,5.046-11.273,11.272v65.179c0,6.225,5.047,11.272,11.273,11.272h17.074v6.765 c0,6.226,5.047,11.273,11.272,11.273h30.943v14.681l32.967,11.391h27.991h74.725h26.097V111.855H125.803z"/> </g> </g> <g> <g> <path d="M450.776,0c-10.201,0-18.472,8.27-18.472,18.472v0.458l-162.329,92.924v175.944l162.329,92.923v0.46 c0,10.201,8.271,18.471,18.472,18.471c10.2,0,18.471-8.271,18.471-18.471V18.472C469.247,8.27,460.977,0,450.776,0z"/> </g> </g> </g>
</svg>
    <span>AMAMAZAHUB</span>
  </div>
      <div class="relative mb-4">
        <input
          type="search"
          placeholder="Search"
          class="bg-gray-500/30 text-sm rounded-full border-none w-full pl-10 p-2.5 focus:ring-pink-500 focus:border-pink-500"
        />
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <i class="uil uil-search text-gray-400"></i>
        </div>
      </div>
      <nav class="space-y-1">
          <button data-nav-link="Following" onclick="loadPage('Following')" data-load="" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-user-plus mr-3 text-xl"></i>
            <span>Following</span>
          </button>

          <button data-nav-link="search" onclick="loadPage('search')" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-search mr-3 text-xl"></i>
            <span>Search</span>
          </button>

          <button data-nav-link="foryou" onclick="loadPage('foryou')" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-star mr-3 text-xl"></i>
            <span>For You</span>
          </button>

          <button data-nav-link="explore" onclick="loadPage('explore')" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-compass mr-3 text-xl"></i>
            <span>Explore</span>
          </button>

          <button data-nav-link="about" onclick="loadPage('messages')" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-envelope mr-3 text-xl"></i>
            <span>Messages</span>
          </button>

          <button data-nav-link="upload" onclick="loadPage('upload')" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900" title="Upload a post">
            <i class="uil uil-plus-circle mr-3 text-xl"></i>
            <span>Upload</span>
          </button>

          <button data-nav-link="profile" onclick="loadPage('profile')" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-user-circle mr-3 text-xl"></i>
            <span>Profile</span>
          </button>

          <button data-nav-link="ads" onclick="loadPage('ads')" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-megaphone mr-3 text-xl"></i>
            <span>Ads Pro</span>
          </button>

          <button data-nav-link="proshop" onclick="loadPage('proshops')" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-store mr-3 text-xl"></i>
            <span>Shops</span>
          </button>

          <button data-nav-link="findnearyou" onclick="loadPage('findnearyou')" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-location-point mr-3 text-xl"></i>
            <span>Find Near You</span>
          </button>

          <button onclick="$('#moreSection').toggleClass()" class="flex items-center p-3 w-full rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-gray-900">
            <i class="uil uil-ellipsis-h mr-3 text-xl"></i>
            <span>More</span>
          </button>
        </nav>

    </div>

    <div class="text-gray-400 text-sm mt-8">&copy; 2025 Amamazahub</div>
  </aside>
