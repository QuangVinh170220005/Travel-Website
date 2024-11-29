@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="relative">
                <img 
                    src="{{ $user->avatar_url ?? 'https://i.pinimg.com/564x/3c/ea/18/3cea18cc4080965bff95b6ca5367c97c.jpg' }}" 
                    alt="Profile photo" 
                    class="w-16 h-16 rounded-full object-cover"
                >
                <div class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
                    </svg>
                </div>
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $user->full_name }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>
            </div>
        </div>
        <form action="{{route('update', ['user' => $user->user_id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Name Fields -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" 
                            name="full_name" 
                            id="full_name" 
                            value="{{ old('full_name', $user->full_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Number Phone</label>
                        <input type="text" 
                            name="phone" 
                            id="phone" 
                            value="{{ old('phone', $user->phone) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                    <input type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <!-- Address -->
                <div class="relative">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <div class="flex">
                        <input type="text" 
                            name="address" 
                            id="address" 
                            value="{{ old('address', $user->address) }}"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                </div>

                <!-- Profile Photo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Profile photo</label>
                    <div class="flex items-center space-x-4">
                        <img 
                            src="{{ $user->avatar_url ?? 'https://i.pinimg.com/564x/3c/ea/18/3cea18cc4080965bff95b6ca5367c97c.jpg' }}" 
                            alt="Current profile photo" 
                            class="w-12 h-12 rounded-full object-cover"
                        >
                        <button type="button" 
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onclick="document.getElementById('avatar').click()"
                        >
                            Click to replace
                        </button>
                        <input type="file" 
                            name="avatar" 
                            id="avatar" 
                            class="hidden"
                            accept="image/*"
                        >
                    </div>
                </div>

                <!-- Delete User Button -->
                <div class="border-t pt-6 mt-6">
                    <button type="button" 
                        class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500"
                        onclick="confirmDelete()"
                    >
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete user
                    </button>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 border-t pt-6">
                    <button type="button" 
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onclick="window.history.back()"
                    >
                        Cancel
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const avatarInput = document.getElementById('avatar');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Handle form submission
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = '{{ route("userManagement") }}';
                    } else {
                        alert(data.message || 'Error updating user');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating');
                });
            });
        }

        // Handle image preview
        if (avatarInput) {
            avatarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const images = document.querySelectorAll('img.w-12.h-12, img.w-16.h-16');
                        images.forEach(img => {
                            img.src = e.target.result;
                        });
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });

    // Handle delete confirmation
    function confirmDelete() {
    return confirm('Are you sure you want to delete this user?');
}
</script>

@endsection