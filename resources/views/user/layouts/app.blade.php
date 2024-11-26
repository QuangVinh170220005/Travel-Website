<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Traveling')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="css/app.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Kalam', cursive;
        }
        /* scrollbar */
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
    
    @yield('styles')

    <!-- Thêm Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans min-h-screen flex flex-col">
    @include('user.partials.header')
    
    <main>
        @yield('content')
    </main>

    @include('user.partials.footer')
    
    @yield('scripts')

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                html: `
                    <div class="flex flex-col gap-2 w-full text-xs">
                        <div class="flex items-center justify-start w-[320px] bg-[#EF665B] p-3 rounded-lg shadow-md font-sans">
                            <div class="w-5 h-5 mr-2 -translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none">
                                    <path fill="#ffffff" d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"></path>
                                </svg>
                            </div>
                            <div class="text-white text-sm font-medium">
                                ${<?php echo json_encode(session('error')); ?>}
                            </div>
                            <div class="w-5 h-5 ml-auto cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20">
                                    <path fill="#ffffff" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                `,
                showConfirmButton: false,
                showCloseButton: false, // Tắt nút close mặc định của SweetAlert2
                background: 'transparent',
                customClass: {
                    popup: 'colored-toast',
                    htmlContainer: 'p-0'
                },
                timer: 5000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
            });
        });


    </script>

    <style>
    .colored-toast.swal2-icon-error {
        background-color: #232531 !important;
    }
    .swal2-popup.swal2-toast {
        padding: 0 !important;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1) !important;
    }
    .swal2-close:focus {
        box-shadow: none !important;
    }
    </style>
    @endif

</body>
</html>
