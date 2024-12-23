<aside class="bg-gray-900 min-h-screen">
    <!-- Logo -->
    <div class="p-4 flex items-center h-16 border-b border-gray-700">
        <span class="text-xl font-bold text-white">Your Logo</span>
    </div>

    <!-- Main Menu -->
    <div class="overflow-y-auto max-h-[calc(100vh-64px)] scrollbar-hide">
        <nav class="p-2 space-y-1">
            <!-- Dashboard -->
            <a href="" 
               data-route="{{ route('admin') }}"
               class="menu-item flex items-center text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200"
               onclick="loadContent(this); return false;">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="ml-3">Dashboard</span>
            </a>

            <!-- Tour Management -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="menu-item w-full flex items-center justify-between text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 10V8a2 2 0 00-2-2H6a2 2 0 00-2 2v2m16 0v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8m16 0h-2m-14 0H4"/>
                        </svg>
                        <span class="ml-3">Tour Management</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" 
                         :class="{'rotate-180': open}"
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="pl-4 mt-2 space-y-1">
                    <a href="" 
                       data-route="{{ route('tours.index') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">All Tours</a>
                    <a href="" 
                       data-route="{{ route('tours.create') }}"
                       data-no-ajax="true"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Create Tour</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Categories</a>
                </div>
            </div>

            <!-- User Management -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="menu-item w-full flex items-center justify-between text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="ml-3">User Management</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" 
                         :class="{'rotate-180': open}"
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="pl-4 mt-2 space-y-1">
                    <a href="" 
                       data-route="{{ route('userManagement') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">All Users</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Add User</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Roles & Permissions</a>
                </div>
            </div>

            <!-- Booking Management -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="menu-item w-full flex items-center justify-between text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="ml-3">Bookings</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" 
                         :class="{'rotate-180': open}"
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="pl-4 mt-2 space-y-1">
                    <a href="" 
                       data-route="{{ route('admin.bookings.all') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">All Bookings</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Pending Bookings</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Booking Reports</a>
                </div>
            </div>

            <!-- Content Management -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="menu-item w-full flex items-center justify-between text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span class="ml-3">Content</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" 
                         :class="{'rotate-180': open}"
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="pl-4 mt-2 space-y-1">
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Pages</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Blog Posts</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Media Library</a>
                </div>
            </div>

                        <!-- Settings -->
                        <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="menu-item w-full flex items-center justify-between text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="ml-3">Settings</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" 
                         :class="{'rotate-180': open}"
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="pl-4 mt-2 space-y-1">
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">General Settings</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Appearance</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Email Settings</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Payment Settings</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Security Settings</a>
                </div>
            </div>

            <!-- Reports -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="menu-item w-full flex items-center justify-between text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="ml-3">Reports</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" 
                         :class="{'rotate-180': open}"
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="pl-4 mt-2 space-y-1">
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Sales Reports</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Booking Reports</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">User Reports</a>
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       onclick="loadContent(this); return false;"
                       class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg">Analytics</a>
                </div>
            </div>

            <!-- Help & Support -->
            <a href="" 
               data-route="{{ route('admin') }}"
               class="menu-item flex items-center text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200"
               onclick="loadContent(this); return false;">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="ml-3">Help & Support</span>
            </a>

            <!-- Profile -->
            <div class="mt-auto">
                <hr class="border-gray-700 my-4">
                <div class="p-2">
                    <a href="" 
                       data-route="{{ route('admin') }}"
                       class="menu-item flex items-center text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200"
                       onclick="loadContent(this); return false;">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="ml-3">Profile</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg p-2 transition-all duration-200">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="ml-3">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</aside>
