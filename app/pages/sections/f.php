  <!-- RIGHT SIDEBAR -->
  <aside class="w-full md:w-64 bg-black border-l border-gray-800 p-4 flex flex-col justify-between mt-4 md:mt-0 hidden md:block">
    <div>
      <div class="text-gray-300 font-medium mb-4 flex items-center">
        <i class="uil uil-mobile-android mr-2 text-pink-500"></i> Get the app
      </div>
      <button data-modal data-title="LOGIN TO AMAMAZAHUB" data-content="SAMPLE LOGIN" class="w-full text-center bg-pink-600 hover:bg-white hover:text-pink-500 p-4 text-white  flex items-center justify-center space-x-2 rounded-full mb-4">
        <i class="uil uil-user-plus text-2xl bg-white p-1 circle text-pink-500"></i>
        <span>Create account</span>
      </button>
      <button class="w-full text-center border border-2 border-pink-600 hover:bg-pink-700 text-white py-2 rounded-full mb-3 flex items-center justify-center space-x-2">
        <i class="uil uil-arrow-to-bottom"></i>
        <span>Download App</span>
      </button>
	  <button id="themeToggle" class="w-full text-center bg-gray-900 hover:bg-gray-700 text-white py-2 rounded-full flex items-center justify-center space-x-2 my-3">
	        <i class="uil uil-moon me-2"></i> Toggle Mode
	      </button>
    </div>

    <div class="hidden md:flex justify-center items-center fixed  end-12 flex-col p-2">
      <button class="bg-gray-900 p-3 circle w-12 h-12 rounded-full hover:bg-gray-700 mb-4">
        <i class="uil uil-arrow-up"></i>
      </button>
      <button class="bg-gray-900 p-3 circle w-12 h-12 rounded-full hover:bg-gray-700">
        <i class="uil uil-arrow-down"></i>
      </button>
    </div>
  </aside>

</div>
      	<nav class="fixed bottom-0  md:hidden block w-full backdrop-blur-sm bg-gray-900/70">
      		<ul class="flex justify-between px-5 py-3 border-t border-gray-700 ">
      			<li>
      				<a href="#" class="flex flex-col text-center">
      					<i class="uil-home"></i>
      					<span class="text-xs">Home</span>
      				</a>
      			</li>
      			<li>
      				<a href="#" class="flex flex-col text-center">
      					<i class="uil-apps"></i>
      					<span class="text-xs">Explore</span>
      				</a>
      			</li>
      			<li>
      				<a href="#" class="flex bg-gray-100 text-gray-900 p-2 px-4 hover:bg-gray-300 rounded-xl border-l-2 border-r-2 border-t-0 border-b-0 border-pink-500 flex-col text-center">
      					<i class="uil-plus"></i>
      				</a>
      			</li>
      			<li>
      				<a href="#" class="flex flex-col text-center">
      					<i class="uil-message"></i>
      					<span class="text-xs">inbox</span>
      				</a>
      			</li>
      			<li>
      				<a href="#" class="flex flex-col text-center">
      					<i class="uil-user"></i>
      					<span class="text-xs">Me</span>
      				</a>
      			</li>
      		</ul>
      	</nav>



<script src="@js"></script>
<script>
$(document).ready(function () {
  // When user clicks on "More" in sidebar
  $('a:contains("More")').on('click', function (e) {
    e.preventDefault();
    $('#moreSection').fadeIn();
  });

  // Close button
  $('#closeMore').on('click', function () {
    $('#moreSection').fadeOut();
  });

  // Handle clicks inside More menu (AJAX simulation)
  $('.more-btn').on('click', function () {
    const section = $(this).data('target');
    $('#moreContent').html('<div class="text-gray-400">Loading...</div>');

    // Simulate AJAX fetch
    setTimeout(() => {
      $.ajax({
        url: `sections/${section}.html`,
        success: function (data) {
          $('#moreContent').html(data);
        },
        error: function () {
          $('#moreContent').html('<p class="text-red-400">Section not found or failed to load.</p>');
        }
      });
    }, 500);
  });
});
</script>

<!-- Flowbite JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const themeToggleBtn = document.getElementById('themeToggle');
  const html = document.documentElement;

  // Load saved preference
  if (localStorage.getItem('theme') === 'dark') {
    html.classList.add('dark');
  } else if (localStorage.getItem('theme') === 'light') {
    html.classList.remove('dark');
  }

  themeToggleBtn.addEventListener('click', () => {
    html.classList.toggle('dark');
    localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
  });
});
</script>
<!-- Alert Container -->
<div id="alert-container" class="z-50 fixed top-10 left-0 w-full text-center flex flex-col justify-center items-center"></div>

<!-- Heroicons CDN -->
<script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>

<script>
  const colors = {
    success: 'bg-green-500 text-white',
    error: 'bg-red-500 text-white',
    warning: 'bg-yellow-400 text-black',
    info: 'bg-gray-500 text-white',
    dark: 'bg-gray-800 text-white',
    light: 'bg-gray-200 text-black'
  };

const icons = {
    success: `<span class="inline-flex items-center justify-center h-4 w-4 rounded-full border-1 border border-current mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </span>`,
    error: `<span class="inline-flex items-center justify-center h-4 w-4 rounded-full border-1 border border-current mr-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </span>`,
    warning: `<span class="inline-flex items-center justify-center h-4 w-4 rounded-full border-1 border border-current mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 2a10 10 0 11-10 10A10 10 0 0112 2z" />
                </svg>
              </span>`,
    info: `<span class="inline-flex items-center justify-center h-4 w-4 rounded-full border-1 border border-current mr-2">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
             </svg>
           </span>`,
    light: `<span class="inline-flex items-center justify-center h-4 w-4 rounded-full border-1 border border-current mr-2">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
             </svg>
           </span>`,
    dark: `<span class="inline-flex items-center justify-center h-4 w-4 rounded-full border-1 border border-current mr-2">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
             </svg>
           </span>`
  };

  function showMessage(message, type = 'error', time = 2000) {
    const alertContainer = document.getElementById('alert-container');
    const alert = document.createElement('span');
    alert.className = `shadow-lg transform transition-all duration-300 translate-y-[-20px] rounded-lg px-4 py-2 mb-3 inline-flex items-center justify-center ${colors[type] || colors.info}`;
    alert.innerHTML = `${icons[type] || ''}${message}`;

    alertContainer.appendChild(alert);
    alertContainer.classList.remove('opacity-0');
    // Show animation
    setTimeout(() => alertContainer.classList.add('opacity-100'), 10);

    // Hide after timeout
    setTimeout(() => {
       alertContainer.classList.add('opacity-0');
       alertContainer.innerHTML = '';
    }, time);
  }
</script>

</body>
</html>
