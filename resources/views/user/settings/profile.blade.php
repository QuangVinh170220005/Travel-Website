<div class="space-y-6">
    <div>
        <h2 class="text-lg font-roboto font-medium   text-gray-900">Profile</h2>
        <p class="text-sm text-gray-500">This is how others will see you on the site.</p>
    </div>

    <!-- Username -->
    <div class="space-y-2">
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text"
            name="username"
            id="username"
            value="{{ $user->username ?? old('username') }}"
            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        <p class="text-xs text-gray-500">
            This is your public display name. It can be your real name or a pseudonym. You can only change this once every 30 days.
        </p>
    </div>

    <!-- Email -->
    <div class="space-y-2">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <select name="email"
            id="email"
            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="{{ $user->email ?? '' }}">{{ $user->email ?? 'Select a verified email to display' }}</option>
        </select>
        <p class="text-xs text-gray-500">
            You can manage verified email addresses in your email settings.
        </p>
    </div>

    <!-- Bio -->
    <div class="space-y-2">
        <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
        <textarea name="bio"
            id="bio"
            rows="3"
            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $user->bio ?? 'I own a computer.' }}</textarea>
        <p class="text-xs text-gray-500">
            You can @mention other users and organizations to link to them.
        </p>
    </div>

    <!-- URLs -->
    <div class="space-y-2">
        <label for="urls" class="block text-sm font-medium text-gray-700">URLs</label>
        <div class="space-y-2">
            <input type="url"
                name="website"
                value="{{ $user->website ?? '' }}"
                placeholder="https://example.com"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <input type="url"
                name="twitter"
                value="{{ $user->twitter ?? '' }}"
                placeholder="http://twitter.com/username"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <button type="button"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Add URL
            </button>
        </div>
        <p class="text-xs text-gray-500">
            Add links to your website, blog, or social media profiles.
        </p>
    </div>

    <!-- Submit Button -->
    <div class="pt-4">
        <button type="submit"
            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Update profile
        </button>
    </div>
</div>