<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <!-- Main Container -->
    <div class="max-w-4xl w-full flex rounded-xl shadow-2xl overflow-hidden">
        <!-- Form Container -->
        <div class="w-full md:w-1/2 glass-effect p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Đăng nhập</h1>
                <p class="text-gray-600">Chào mừng bạn quay trở lại!</p>
            </div>

            <!-- Social Login Buttons -->
            <div class="space-y-3 mb-6">
                <button class="w-full flex items-center justify-center gap-2 bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-700 hover:bg-gray-50 transition duration-300">
                    <img src="https://www.google.com/favicon.ico" alt="Google" class="w-5 h-5">
                    Đăng nhập với Google
                </button>
                <button class="w-full flex items-center justify-center gap-2 bg-[#1877f2] text-white rounded-lg px-4 py-2 hover:bg-[#1865d1] transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                    Đăng nhập với Facebook
                </button>
            </div>

            <div class="relative flex items-center justify-center mb-6">
                <div class="border-t border-gray-300 w-full"></div>
                <div class="bg-white px-4 text-sm text-gray-500">hoặc</div>
                <div class="border-t border-gray-300 w-full"></div>
            </div>

            <!-- Login Form -->
            <form class="space-y-6" action="{{route('login')}}" method="post">
            @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email hoặc tên đăng nhập
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="far fa-envelope"></i>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"   
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="example@domain.com" required autofocus>
                               @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Mật khẩu
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" required
                               id="password" 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="••••••••">
                               @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                            <i id="eye-icon" class="far fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Quên mật khẩu?
                    </a>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white rounded-lg px-4 py-2 font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300">
                    Đăng nhập
                </button>
            </form>

            <!-- Chuyển hướng đăng ký -->
            <p class="mt-6 text-center text-sm text-gray-600">
                Chưa có tài khoản? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                    Đăng ký ngay
                </a>
            </p>
        </div>

        <!-- Right Side - Image -->
        <div class="hidden md:block md:w-1/2 bg-cover bg-center" 
             style="background-image: url('https://images.unsplash.com/photo-1579547621113-e4bb2a19bdd6?auto=format&fit=crop&w=800&q=80')">
        </div>
    </div>
</body>
</html>
