<div x-data="followersGrid()" x-init="init()" class="p-4 grid gap-4 grid-cols-1 hidden sm:grid-cols-2 md:grid-cols-3">
    <template x-for="follower in followers" :key="follower.id">
        <div class="relative group rounded-lg overflow-hidden shadow-lg">
            <!-- Background image blurred -->
            <div class="absolute inset-0">
                <img :src="follower.latest_video_thumbnail || follower.profile_image" class="w-full h-full object-cover filter blur-sm scale-110" alt="background">
            </div>

            <!-- Centered circle profile image -->
            <div class="absolute inset-0 flex flex-col justify-center items-center z-10">
                <img :src="follower.profile_image" class="w-16 h-16 rounded-full border-2 border-white mb-2" alt="profile">
                <strong class="text-white text-center" x-text="follower.username"></strong>
            </div>

            <!-- Hover video -->
            <video 
                x-show="follower.latest_video_url" 
                :src="follower.latest_video_url" 
                class="w-full h-full object-cover absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                autoplay muted loop playsinline></video>

            <!-- Follow button -->
            <button @click="toggleFollow(follower.id)" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white px-4 py-1 rounded-full z-10">
                <span x-text="follower.following ? 'Following' : 'Follow'"></span>
            </button>
        </div>
    </template>

    <!-- Load more on scroll -->
    <div x-show="loading" class="col-span-full text-center py-4 text-gray-500">Loading...</div>
</div>



<div class="bg-gray-100 dark:bg-black min-h-screen p-6">

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Profile Card -->
    <div class="dark:bg-slate-900 bg-white rounded-lg shadow-md p-4 flex flex-col items-center text-center">
      <img src="https://picsum.photos/200" alt="Ranjan SP8055" class="rounded-full w-24 h-24 mb-3">
      <h3 class="text-lg font-semibold">Ranjan SP8055</h3>
      <p class="text-sm text-gray-500">@ranjan_sp17</p>
      <button class="mt-3 bg-pink-700 py-2 px-3 rounded w-full">Follow</button>
    </div>

    <!-- Profile Card -->
    <div class="dark:bg-slate-900 bg-white rounded-lg shadow-md p-4 flex flex-col items-center text-center">
      <img src="https://picsum.photos/200" alt="llauraperezgarcia" class="rounded-full w-24 h-24 mb-3">
      <h3 class="text-lg font-semibold">llauraperezgarcia</h3>
      <p class="text-sm text-gray-500">@llauraperezgarcia</p>
      <button class="mt-3 bg-pink-700 py-2 px-3 rounded w-full">Follow</button>
    </div>

    <!-- Profile Card -->
    <div class="dark:bg-slate-900 bg-white rounded-lg shadow-md p-4 flex flex-col items-center text-center">
      <img src="https://picsum.photos/200" alt="旅人ぴきちん" class="rounded-full w-24 h-24 mb-3">
      <h3 class="text-lg font-semibold">旅人ぴきちん</h3>
      <p class="text-sm text-gray-500">@travel_pikichin</p>
      <button class="mt-3 bg-pink-700 py-2 px-3 rounded w-full">Follow</button>
    </div>

    <!-- Profile Card -->
    <div class="dark:bg-slate-900 bg-white rounded-lg shadow-md p-4 flex flex-col items-center text-center">
      <img src="https://picsum.photos/200" alt="NickyBoo" class="rounded-full w-24 h-24 mb-3">
      <h3 class="text-lg font-semibold">NickyBoo</h3>
      <p class="text-sm text-gray-500">@itsah_kiki</p>
      <button class="mt-3 bg-pink-700 py-2 px-3 rounded w-full">Follow</button>
    </div>

    <!-- Profile Card -->
    <div class="dark:bg-slate-900 bg-white rounded-lg shadow-md p-4 flex flex-col items-center text-center">
      <img src="https://picsum.photos/200" alt="Goodbye Rwanda" class="rounded-full w-24 h-24 mb-3">
      <h3 class="text-lg font-semibold">Goodbye Rwanda 😢</h3>
      <p class="text-sm text-gray-500">Goodbye TikTok 😢</p>
      <button class="mt-3 bg-pink-700 py-2 px-3 rounded w-full">Follow</button>
    </div>

    <!-- Profile Card -->
    <div class="dark:bg-slate-900 bg-white rounded-lg shadow-md p-4 flex flex-col items-center text-center">
      <img src="https://picsum.photos/200" alt="Sameera" class="rounded-full w-24 h-24 mb-3">
      <h3 class="text-lg font-semibold">Sameera</h3>
      <p class="text-sm text-gray-500">@sameera_va_rugira</p>
      <button class="mt-3 bg-pink-700 py-2 px-3 rounded w-full">Follow</button>
    </div>
  </div>
</div>



<!-- <script>
function followersGrid() {
    return {
        followers: [],
        page: 1,
        loading: false,
        init() {
            this.loadFollowers();

            // Infinite scroll
            window.addEventListener('scroll', () => {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500 && !this.loading) {
                    this.loadFollowers();
                }
            });
        },
        async loadFollowers() {
            this.loading = true;
            const res = await fetch(`api/api?action=get_new_followers&page=${this.page}`);
            const data = await res.json();

            // Each follower should contain latest 14 contents
            for (let follower of data.followers) {
                const contentRes = await fetch(`api/api?action=get_user_contents&user_id=${follower.id}&limit=14`);
                const contents = await contentRes.json();
                follower.contents = contents.items || [];

                // Find latest video
                const latestVideo = follower.contents.find(c => c.media_type === 'video');
                follower.latest_video_url = latestVideo ? latestVideo.media_url : null;
                follower.latest_video_thumbnail = latestVideo ? latestVideo.thumbnail_url : null;
            }

            this.followers.push(...data.followers);
            this.page++;
            this.loading = false;
        },
        toggleFollow(userId) {
            let follower = this.followers.find(f => f.id === userId);
            follower.following = !follower.following;
            // Send follow/unfollow API
            fetch(`api/api?action=toggle_follow&user_id=${userId}`, { method: 'POST' });
        }
    }
}
</script>
 -->