// function app() {
//   return {
//     // 🧭 Menu items
//     menu: [
//       { id: 'following', label: 'Following', icon: 'uil uil-user-plus', url: 'https://jsonplaceholder.typicode.com/users' },
//       { id: 'search', label: 'Search', icon: 'uil uil-search', url: 'https://jsonplaceholder.typicode.com/posts' },
//       { id: 'explore', label: 'Explore', icon: 'uil uil-compass', url: 'https://jsonplaceholder.typicode.com/comments' },
//     ],

//     // ⚙️ Reactive state
//     active: localStorage.getItem('activeTab') || 'following',
//     content: 'Loading...',
//     history: [],
//     position: -1,

//     // 🏁 Initialize
//     init() {
//       // Load initial tab
//       this.loadContent(this.active, false);

//       // Handle browser navigation
//       window.addEventListener('popstate', (event) => {
//         if (event.state && event.state.id) {
//           this.loadContent(event.state.id, false);
//         }
//       });
//     },

//     // 🚀 Navigate function
//     navigate(item) {
//       this.active = item.id;
//       localStorage.setItem('activeTab', item.id);
//       this.loadContent(item.id);
//       history.pushState({ id: item.id }, '', `#${item.id}`);
//     },

//     // 📡 Fetch content dynamically
//     async loadContent(id, pushToHistory = true) {
//       const item = this.menu.find(m => m.id === id);
//       if (!item) return;

//       this.content = '<p class="text-gray-400">Loading...</p>';
//       try {
//         const res = await fetch(item.url);
//         const data = await res.json();

//         // Simple render
//         this.content = `
//           <h1 class="text-2xl font-bold mb-4 capitalize">${item.label}</h1>
//           <pre class="bg-gray-800 p-4 rounded-xl text-sm overflow-x-auto">${JSON.stringify(data.slice(0, 5), null, 2)}</pre>
//         `;

//         // Custom navigation history array
//         if (pushToHistory) {
//           this.history.push(id);
//           this.position = this.history.length - 1;
//         }

//       } catch (e) {
//         this.content = `<p class="text-red-500">Error loading ${item.label}</p>`;
//       }
//     }
//   }
// }