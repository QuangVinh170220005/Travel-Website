

@extends('admin.layouts.app')
@section('title', 'User Management')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">User Management</h1>
        <p class="text-gray-600">Manage all system users</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-3 px-4 border-b text-left font-semibold text-gray-600">Name</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-gray-600">Role</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-gray-600">Number Phone</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-gray-600">Address</th>
                        <th class="py-3 px-4 border-b text-right font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">
                            <div class="flex items-center">
                                <img 
                                    src="{{ $user->avatar_url ?? 'https://i.pinimg.com/564x/3c/ea/18/3cea18cc4080965bff95b6ca5367c97c.jpg' }}" 
                                    alt="Avatar" 
                                    class="rounded-full mr-3 w-10 h-10 object-cover object-center"
                                >
                                <div>
                                    <div class="font-medium text-gray-900">{{ $user->full_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 border-b">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $user->role === 'ADMIN' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3 px-4 border-b text-gray-500">{{ $user->phone }}</td>
                        <td class="py-3 px-4 border-b text-gray-500">{{ $user->address }}</td>
                        <td class="py-3 px-4 border-b">
                            <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('showInFor', ['user' => $user->user_id]) }}"
                                data-route="{{ route('showInFor', ['user' => $user->user_id]) }}" 
                                class="text-gray-400 hover:text-blue-600 transition-colors"
                                onclick="loadContent(this); return false;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                 </svg>
                            </a>
                            <form action="{{ route('deleteUser', ['user' => $user->user_id]) }}" 
                                method="POST" 
                                class="inline-block delete-user-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="text-gray-400 hover:text-red-600 transition-colors delete-user-btn"
                                    data-user-name="{{ $user->full_name }}"
                                    onclick="return confirmDelete(event, '{{ $user->full_name }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @if($users->isEmpty())
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500">
                            No users found
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function loadContent(element) {
    const route = element.getAttribute('data-route');
    
    // Hiển thị loading
    const mainContent = document.querySelector('.p-6.ml-64');
    mainContent.innerHTML = '<div class="flex justify-center items-center h-screen"><div class="animate-spin rounded-full h-32 w-32 border-b-2 border-gray-900"></div></div>';

    // Fetch content
    fetch(route, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        // Cập nhật URL
        window.history.pushState({}, '', route);
        
        // Parse và update content
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const content = doc.querySelector('.p-6.ml-64');
        
        if (content) {
            mainContent.innerHTML = content.innerHTML;
            
            // Re-run scripts
            const scripts = content.getElementsByTagName('script');
            Array.from(scripts).forEach(script => {
                const newScript = document.createElement('script');
                Array.from(script.attributes).forEach(attr => {
                    newScript.setAttribute(attr.name, attr.value);
                });
                newScript.appendChild(document.createTextNode(script.innerHTML));
                script.parentNode.replaceChild(newScript, script);
            });
        } else {
            mainContent.innerHTML = '<div class="text-red-500">Error: Content not found</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mainContent.innerHTML = '<div class="text-red-500">Error loading content</div>';
    });
}

// Xử lý nút back/forward của trình duyệt
window.addEventListener('popstate', function() {
    loadContent({ getAttribute: () => window.location.href });
});

<!-- Add Alpine.js -->

function confirmDelete(event, userName) {
    event.preventDefault();
    if (confirm(`Are you sure you want to delete user "${userName}"?`)) {
        event.target.closest('form').submit();
    }
    return false;
}

// Thêm xử lý response sau khi xóa
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = "{{ session('success') }}";
    const errorMessage = "{{ session('error') }}";
    
    if (successMessage) {
        alert(successMessage);
    }
    if (errorMessage) {
        alert(errorMessage);
    }
});
</script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection