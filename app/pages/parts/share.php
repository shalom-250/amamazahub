<!-- Flowbite CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet">

<!-- Modal Trigger -->
<button data-modal-target="shareModal" data-modal-toggle="shareModal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
  Share
</button>

<!-- Modal -->
<div id="shareModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
  <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto mt-20">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <!-- Close button -->
      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="shareModal">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Close modal</span>
      </button>

      <!-- Modal body -->
      <div class="px-6 py-6 lg:px-8">
        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Share</h3>
        
        <!-- Share link input -->
        <div class="flex items-center mb-4">
          <input type="text" value="https://example.com/video/123" id="shareLink" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" readonly>
          <button id="copyButton" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700">Copy</button>
        </div>

        <!-- Social share buttons -->
        <div class="flex space-x-4">
          <a href="#" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 001.88-2.38 8.59 8.59 0 01-2.72 1.04 4.28 4.28 0 00-7.3 3.9 12.16 12.16 0 01-8.82-4.48 4.28 4.28 0 001.32 5.72 4.27 4.27 0 01-1.94-.53v.05a4.28 4.28 0 003.44 4.19 4.3 4.3 0 01-1.93.07 4.28 4.28 0 003.99 2.97A8.59 8.59 0 012 19.54a12.12 12.12 0 006.56 1.92c7.88 0 12.2-6.53 12.2-12.2l-.01-.56A8.72 8.72 0 0024 4.56a8.51 8.51 0 01-2.54.7z"></path></svg>
          </a>
          <a href="#" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-800 hover:bg-blue-900 text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm1.25 14.1h-2.5v-5.3h2.5zm0-6.7h-2.5V7.5h2.5z"></path></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Flowbite JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

<!-- Copy link functionality -->
<script>
  const copyButton = document.getElementById('copyButton');
  const shareLink = document.getElementById('shareLink');

  copyButton.addEventListener('click', () => {
    shareLink.select();
    shareLink.setSelectionRange(0, 99999); // For mobile
    navigator.clipboard.writeText(shareLink.value);
    copyButton.textContent = 'Copied!';
    setTimeout(() => copyButton.textContent = 'Copy', 2000);
  });
</script>
