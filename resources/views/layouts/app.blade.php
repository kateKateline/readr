<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>Readr - Manga Reader</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/show.js','resources/js/read.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-[#0d1117] text-[#c9d1d9] min-h-screen flex flex-col font-sans">

    <!-- Header -->
    @include('partials.layout.header')

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.layout.footer')

<!-- Tambahkan script ini di bagian bawah layouts/app.blade.php sebelum </body> -->

@stack('scripts')

<script>
    // Auto scroll chat ke bawah saat page load
    document.addEventListener('DOMContentLoaded', function() {
        const chatContainer = document.querySelector('.chat-scrollbar');
        
        if (chatContainer) {
            // Scroll ke bawah
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });

    // Optional: Auto refresh chat setiap 10 detik (jika ingin real-time)
    // Uncomment kode di bawah jika ingin fitur auto-refresh
    
    /*
    setInterval(function() {
        // Reload hanya bagian chat tanpa refresh seluruh halaman
        fetch(window.location.href)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newChatContainer = doc.querySelector('.chat-scrollbar');
                const currentChatContainer = document.querySelector('.chat-scrollbar');
                
                if (newChatContainer && currentChatContainer) {
                    const isAtBottom = currentChatContainer.scrollHeight - currentChatContainer.clientHeight <= currentChatContainer.scrollTop + 1;
                    
                    currentChatContainer.innerHTML = newChatContainer.innerHTML;
                    
                    // Scroll ke bawah jika user sudah di bawah sebelumnya
                    if (isAtBottom) {
                        currentChatContainer.scrollTop = currentChatContainer.scrollHeight;
                    }
                }
            })
            .catch(error => console.error('Error refreshing chat:', error));
    }, 10000); // Refresh setiap 10 detik
    */
</script>

</body>
</html>
