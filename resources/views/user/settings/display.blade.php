<div class="space-y-6">
    <!-- Layout Preferences -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-medium font-roboto text-gray-900 mb-4">Layout Preferences</h2>
        <div class="space-y-4">
            <!-- Content Density -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Content Density</label>
                <div class="grid grid-cols-3 gap-4">
                    <button class="text-center p-4 border rounded-lg hover:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="fas fa-compress-alt text-xl mb-2"></i>
                        <p class="text-sm">Compact</p>
                    </button>
                    <button class="text-center p-4 border rounded-lg border-indigo-500 bg-indigo-50">
                        <i class="fas fa-arrows-alt-h text-xl mb-2"></i>
                        <p class="text-sm">Comfortable</p>
                    </button>
                    <button class="text-center p-4 border rounded-lg hover:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="fas fa-expand-alt text-xl mb-2"></i>
                        <p class="text-sm">Spacious</p>
                    </button>
                </div>
            </div>

            <!-- Content Width -->
            <div class="pt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Content Width</label>
                <div class="flex items-center space-x-4">
                    <input type="range" min="800" max="1600" value="1200" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                    <span class="text-sm text-gray-600">1200px</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual Preferences -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Visual Preferences</h2>
        <div class="space-y-4">
            <!-- Card Style -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Card Style</label>
                <div class="grid grid-cols-3 gap-4">
                    <div class="border rounded-lg p-4 cursor-pointer hover:border-indigo-500">
                        <div class="h-20 bg-gray-100 rounded mb-2"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-gray-100 rounded w-3/4"></div>
                            <div class="h-3 bg-gray-100 rounded w-1/2"></div>
                        </div>
                    </div>
                    <div class="border rounded-lg p-4 cursor-pointer border-indigo-500 bg-indigo-50">
                        <div class="h-20 bg-gray-100 rounded-lg mb-2 shadow"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-gray-100 rounded w-3/4"></div>
                            <div class="h-3 bg-gray-100 rounded w-1/2"></div>
                        </div>
                    </div>
                    <div class="border rounded-lg p-4 cursor-pointer hover:border-indigo-500">
                        <div class="h-20 bg-gray-100 rounded-xl mb-2 shadow-lg"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-gray-100 rounded w-3/4"></div>
                            <div class="h-3 bg-gray-100 rounded w-1/2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Animation -->
            <div class="pt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Animation Effects</label>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label class="ml-2 text-sm text-gray-700">Enable animations</label>
                        </div>
                        <select class="text-sm border-gray-300 rounded-md">
                            <option>Normal</option>
                            <option>Reduced</option>
                            <option>Minimal</option>
                        </select>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm text-gray-700">Smooth scrolling</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm text-gray-700">Transition effects</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accessibility -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Accessibility</h2>
        <div class="space-y-4">
            <!-- Text Size -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Text Size</label>
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-xs border rounded hover:bg-gray-50">A</button>
                    <button class="p-2 text-sm border rounded hover:bg-gray-50">A</button>
                    <button class="p-2 text-base border rounded bg-indigo-50 border-indigo-500">A</button>
                    <button class="p-2 text-lg border rounded hover:bg-gray-50">A</button>
                    <button class="p-2 text-xl border rounded hover:bg-gray-50">A</button>
                </div>
            </div>

            <!-- Contrast -->
            <div class="pt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Contrast</label>
                <div class="flex items-center space-x-4">
                    <button class="flex-1 py-2 px-4 border rounded-md hover:bg-gray-50">
                        Normal
                    </button>
                    <button class="flex-1 py-2 px-4 border rounded-md bg-indigo-50 border-indigo-500">
                        Medium
                    </button>
                    <button class="flex-1 py-2 px-4 border rounded-md hover:bg-gray-50">
                        High
                    </button>
                </div>
            </div>

            <!-- Focus Indicators -->
            <div class="pt-4">
                <div class="flex items-center justify-between">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Focus Indicators</label>
                        <p class="text-sm text-gray-500">Show visual indicators for keyboard navigation</p>
                    </div>
                    <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-indigo-600 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" role="switch" aria-checked="true">
                        <span class="translate-x-5 pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Save Display Settings
        </button>
    </div>
</div>