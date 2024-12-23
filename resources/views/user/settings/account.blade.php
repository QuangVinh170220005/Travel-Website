<div class="space-y-6">
    <div>
        <h2 class="text-lg font-medium font-roboto text-gray-900">Account Settings</h2>
        <p class="text-sm text-gray-500">Manage your account security and contact information</p>
    </div>

    <!-- Basic Information -->
    <div class="bg-white p-6 rounded-lg border border-gray-200">
        <h3 class="text-md font-medium font-robotoroboto text-gray-900 mb-4">Basic Information</h3>

        <!-- Email -->
        <div class="space-y-2 mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email"
                name="email"
                id="email"
                value="{{ $user->email }}"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 cursor-not-allowed sm:text-sm"
                disabled>
            <p class="text-xs text-gray-500">Your email address is used for login and cannot be changed here.</p>
        </div>

        <!-- Full Name -->
        <div class="space-y-2 mb-4">
            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text"
                name="full_name"
                id="full_name"
                value="{{ $user->full_name ?? old('full_name') }}"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>

        <!-- Phone -->
        <div class="space-y-2 mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="tel"
                name="phone"
                id="phone"
                value="{{ $user->phone ?? old('phone') }}"
                placeholder="Enter your phone number"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>

        <!-- Address -->
        <div class="space-y-2">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <textarea name="address"
                id="address"
                rows="3"
                placeholder="Enter your address"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $user->address ?? old('address') }}</textarea>
        </div>
    </div>

    <!-- Security Settings -->
    <div class="bg-white p-6 rounded-lg border border-gray-200">
        <h3 class="text-md font-medium text-gray-900 mb-4">Security</h3>

        <!-- Change Password -->
        <div class="space-y-4">
            <div class="space-y-2">
                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password"
                    name="current_password"
                    id="current_password"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div class="space-y-2">
                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password"
                    name="new_password"
                    id="new_password"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div class="space-y-2">
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password"
                    name="new_password_confirmation"
                    id="new_password_confirmation"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <p class="text-xs text-gray-500">
                Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.
            </p>
        </div>
    </div>

    <!-- Account Status -->
    <div class="bg-white p-6 rounded-lg border border-gray-200">
        <h3 class="text-md font-medium text-gray-900 mb-4">Account Information</h3>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Account Type</p>
                <p class="text-sm font-medium text-gray-900">{{ ucfirst($user->role) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Member Since</p>
                <p class="text-sm font-medium text-gray-900">
                    {{ $user->created_at instanceof \DateTime ? $user->created_at->format('F d, Y') : date('F d, Y', strtotime($user->created_at)) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="pt-4">
        <button type="submit"
            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Save Changes
        </button>
    </div>
</div>