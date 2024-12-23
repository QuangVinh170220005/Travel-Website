<div class="space-y-6">
    <!-- Theme Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-medium font-roboto text-gray-900 mb-4">Theme Settings</h2>
        <div class="space-y-4">
            <!-- Theme Mode -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Theme Mode</label>
                <div class="flex space-x-4">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-sun mr-2"></i>Light
                    </button>
                    <button class="px-4 py-2 bg-gray-800 border border-transparent rounded-md text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-moon mr-2"></i>Dark
                    </button>
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-desktop mr-2"></i>System
                    </button>
                </div>
            </div>

            <!-- Color Scheme -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Color Scheme</label>
                <div class="grid grid-cols-6 gap-3">
                    <button class="w-8 h-8 rounded-full bg-blue-500 ring-2 ring-offset-2 ring-blue-500"></button>
                    <button class="w-8 h-8 rounded-full bg-green-500 hover:ring-2 hover:ring-offset-2 hover:ring-green-500"></button>
                    <button class="w-8 h-8 rounded-full bg-purple-500 hover:ring-2 hover:ring-offset-2 hover:ring-purple-500"></button>
                    <button class="w-8 h-8 rounded-full bg-red-500 hover:ring-2 hover:ring-offset-2 hover:ring-red-500"></button>
                    <button class="w-8 h-8 rounded-full bg-yellow-500 hover:ring-2 hover:ring-offset-2 hover:ring-yellow-500"></button>
                    <button class="w-8 h-8 rounded-full bg-pink-500 hover:ring-2 hover:ring-offset-2 hover:ring-pink-500"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Settings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Font Settings</h2>
        <div class="space-y-4">
            <!-- Font Size -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Font Size</label>
                <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                    <option>Small</option>
                    <option selected>Medium</option>
                    <option>Large</option>
                </select>
            </div>

            <!-- Font Family -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Font Family</label>
                <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                    <option>System Default</option>
                    <option>Roboto</option>
                    <option>Open Sans</option>
                    <option>Lato</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Layout Settings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Layout Settings</h2>
        <div class="space-y-4">
            <!-- Sidebar Position -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sidebar Position</label>
                <div class="flex space-x-4">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-arrow-left mr-2"></i>Left
                    </button>
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-arrow-right mr-2"></i>Right
                    </button>
                </div>
            </div>

            <!-- Content Width -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Content Width</label>
                <div class="flex space-x-4">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-compress mr-2"></i>Fixed
                    </button>
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-expand mr-2"></i>Full Width
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Save Changes
        </button>
    </div>
</div>