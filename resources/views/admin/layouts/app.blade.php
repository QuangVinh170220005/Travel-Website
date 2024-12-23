<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administrator')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'kalam': ['Kalam', 'cursive'],
                        'roboto': ['Roboto', 'sans-serif'],
                    },
                },
            },
        }
    </script>

    <!-- Custom Styles -->
    <style type="text/css">
        body {
            font-family: 'Roboto', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Kalam', cursive;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        [x-cloak] {
            display: none !important;
        }

        ::-webkit-scrollbar {
            width: 7px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #cbd5e1;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }

        ::-webkit-scrollbar-thumb:window-inactive {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('styles')
</head>

<body class="font-sans min-h-screen bg-gray-100">
    <div class="grid grid-cols-[256px_1fr]">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <main class="min-h-screen">
            <div id="content-container" class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        function loadContent(element) {
            if (element.classList.contains('form-navigation') || element.hasAttribute('data-no-ajax')) {
                window.location.href = element.getAttribute('data-route');
                return;
            }
            const route = element.getAttribute('data-route');

            // Hiển thị loading indicator
            document.getElementById('content-container').innerHTML = '<div class="flex justify-center items-center h-screen"><div class="animate-spin rounded-full h-32 w-32 border-b-2 border-gray-900"></div></div>';

            // Sử dụng fetch để lấy nội dung
            fetch(route, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html, application/xhtml+xml',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Cập nhật URL mà không reload trang
                    window.history.pushState({}, '', route);

                    // Parse HTML response để lấy phần content
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Chỉ lấy nội dung trong #content-container
                    const contentOnly = doc.querySelector('#content-container');
                    if (contentOnly) {
                        document.getElementById('content-container').innerHTML = contentOnly.innerHTML;
                    } else {
                        // Nếu không tìm thấy #content-container, có thể đây là partial view
                        document.getElementById('content-container').innerHTML = html;
                    }

                    // Highlight active menu item
                    document.querySelectorAll('.menu-item').forEach(item => {
                        item.classList.remove('bg-gray-800', 'text-white');
                        if (item.getAttribute('data-route') === route) {
                            item.classList.add('bg-gray-800', 'text-white');
                        }
                    });

                    // Re-initialize any JavaScript components if needed
                    if (typeof initializeComponents === 'function') {
                        initializeComponents();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('content-container').innerHTML = '<div class="text-red-500">Error loading content</div>';
                });
        }

        // Xử lý back/forward browser buttons
        window.addEventListener('popstate', function(event) {
            const route = window.location.pathname;
            const menuItem = document.querySelector(`[data-route="${route}"]`);
            if (menuItem) {
                loadContent(menuItem);
            }
        });

        // Function để initialize các components (nếu cần)
        function initializeComponents() {
            // Add any initialization code here
            // For example: reinitialize tooltips, datepickers, etc.
        }

        // Thêm xử lý cho initial page load
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItem = document.querySelector(`[data-route="${currentPath}"]`);
            if (menuItem) {
                menuItem.classList.add('bg-gray-800', 'text-white');
            }
        });
    </script>
</body>

</html>