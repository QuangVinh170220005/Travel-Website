@extends('user.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- Thêm container và padding --}}
        <div class="bg-white rounded-lg shadow">
            <!-- Settings Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-xl font-roboto font-medium text-gray-800">Settings</h1>
                <p class="text-sm text-gray-600">Manage your account settings and set e-mail preferences.</p>
            </div>

            <!-- Settings Navigation -->
            <div class="grid grid-cols-12 divide-x divide-gray-200">
                <!-- Sidebar -->
                <div class="col-span-12 md:col-span-3 py-6"> {{-- Thêm responsive --}}
                    <nav class="space-y-1">
                        <a href="#"
                            data-section="profile"
                            class="settings-nav-item block px-6 py-2 text-sm text-gray-900 bg-gray-50 hover:bg-gray-50 transition duration-150">
                            <i class="far fa-user mr-2"></i>Profile {{-- Thêm icon --}}
                        </a>
                        <a href="#"
                            data-section="account"
                            class="settings-nav-item block px-6 py-2 text-sm text-gray-600 hover:bg-gray-50 transition duration-150">
                            <i class="fas fa-shield-alt mr-2"></i>Account {{-- Thêm icon --}}
                        </a>
                        <a href="#"
                            data-section="appearance"
                            class="settings-nav-item block px-6 py-2 text-sm text-gray-600 hover:bg-gray-50 transition duration-150">
                            <i class="fas fa-paint-brush mr-2"></i>Appearance {{-- Thêm icon --}}
                        </a>
                        <a href="#"
                            data-section="notifications"
                            class="settings-nav-item block px-6 py-2 text-sm text-gray-600 hover:bg-gray-50 transition duration-150">
                            <i class="far fa-bell mr-2"></i>Notifications {{-- Thêm icon --}}
                        </a>
                        <a href="#"
                            data-section="display"
                            class="settings-nav-item block px-6 py-2 text-sm text-gray-600 hover:bg-gray-50 transition duration-150">
                            <i class="fas fa-desktop mr-2"></i>Display {{-- Thêm icon --}}
                        </a>
                    </nav>
                </div>

                <!-- Main Content -->
                <div class="col-span-12 md:col-span-9 py-6 px-8"> {{-- Thêm responsive --}}
                    <div id="settings-content" class="min-h-[300px]"> {{-- Thêm min-height --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = document.querySelectorAll('.settings-nav-item');
        const contentDiv = document.querySelector('#settings-content');
        const baseUrl = '{{ url("/settings") }}';
        const currentSection = '{{ $currentSection ?? "profile" }}';

        // Load content nếu có currentSection được truyền từ controller
        if (currentSection) {
            loadSection(currentSection);
            updateActiveNav(currentSection);
        } else {
            loadSection('profile');
            updateActiveNav('profile');
        }


        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const section = this.getAttribute('data-section');

                // Cập nhật URL mà không reload trang
                window.history.pushState({
                    section
                }, '', `${baseUrl}/${section}`);

                updateActiveNav(section);
                loadSection(section);
            });
        });

        // Xử lý khi người dùng sử dụng nút back/forward của trình duyệt
        window.addEventListener('popstate', function(e) {
            const section = window.location.pathname.split('/').pop() || 'account';
            updateActiveNav(section);
            loadSection(section);
        });

        function updateActiveNav(section) {
            navItems.forEach(nav => {
                // Xóa tất cả các class có thể ảnh hưởng
                nav.classList.remove('bg-gray-100', 'bg-gray-50', 'text-gray-900');
                nav.classList.add('text-gray-600');

                if (nav.getAttribute('data-section') === section) {
                    nav.classList.remove('text-gray-600');
                    nav.classList.add('bg-gray-100', 'text-gray-900');
                }
            });
        }


        function loadSection(section) {
            // Thêm header để đánh dấu request là AJAX
            fetch(`${baseUrl}/${section}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    contentDiv.innerHTML = html;

                    // Reapply CSS classes after content load
                    const elements = contentDiv.querySelectorAll('*');
                    elements.forEach(element => {
                        if (element.classList.length > 0) {
                            element.classList.forEach(className => {
                                element.classList.remove(className);
                                element.classList.add(className);
                            });
                        }
                    });

                    // Handle forms if they exist
                    const form = contentDiv.querySelector('form');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            showToast('Settings updated successfully', 'success');
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    contentDiv.innerHTML = '<p class="text-red-500">Error loading content</p>';
                });
        }
    });
</script>
@endsection