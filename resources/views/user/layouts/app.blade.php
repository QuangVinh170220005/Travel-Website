<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Traveling')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

        /* Scrollbar Styles */
        ::-webkit-scrollbar {
            width: 7px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: #cbd5e1;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }

        ::-webkit-scrollbar-thumb:window-inactive {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Chat Widget Styles */
        .typing-indicator {
            display: flex;
            align-items: center;
            padding: 10px;
        }

        .typing-indicator span {
            height: 8px;
            width: 8px;
            background: #1a73e8;
            border-radius: 50%;
            margin: 0 2px;
            animation: typing 1s infinite;
        }

        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .chat-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #1a73e8;
            color: white;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .chat-button:hover {
            transform: scale(1.1);
        }

        .chat-container {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s;
        }

        .chat-container.active {
            opacity: 1;
            visibility: visible;
        }

        .chat-header {
            padding: 15px;
            background: #1a73e8;
            color: white;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-box {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            background: #f8f9fa;
        }

        .chat-input {
            padding: 15px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 10px;
        }

        .chat-input input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
        }

        .chat-input input:focus {
            border-color: #1a73e8;
        }

        .chat-input button {
            padding: 8px 15px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .chat-input button:hover {
            background: #1557b0;
        }

        .message {
            margin: 8px 0;
            padding: 10px;
            border-radius: 10px;
            max-width: 80%;
            word-wrap: break-word;
        }

        .user-message {
            background: #e3f2fd;
            margin-left: auto;
            color: #1a73e8;
        }

        /* Thêm vào phần style trong head */
.ai-message {
    background: #f5f5f5;
    margin-right: auto;
    color: #333;
    line-height: 1.6;
}

.ai-message h3 {
    color: #1a73e8;
    font-weight: bold;
    margin: 10px 0 5px 0;
}

.ai-message ul {
    margin-left: 20px;
    list-style-type: disc;
}

.ai-message ol {
    margin-left: 20px;
    list-style-type: decimal;
}

.ai-message p {
    margin: 8px 0;
}

.ai-message a {
    color: #1a73e8;
    text-decoration: underline;
}

.ai-message .highlight {
    background-color: #fff3cd;
    padding: 2px 5px;
    border-radius: 3px;
}

.ai-message .divider {
    border-top: 1px solid #ddd;
    margin: 10px 0;
}


        [x-cloak] {
            display: none !important;
        }
    </style>

    @yield('styles')
</head>

<body class="font-sans min-h-screen flex flex-col">
    @include('user.partials.header')

    <main>
        @yield('content')
    </main>

    @include('user.partials.footer')

    <!-- Chat Widget -->
    <div class="chat-widget" x-data="chatWidget">
        <button class="chat-button" @click="toggleChat">
            <i class="fas fa-comments"></i>
        </button>

        <div class="chat-container" :class="{'active': isOpen}" x-show="true" x-cloak>
            <div class="chat-header">
                <h3>AI Assistant</h3>
                <button @click="toggleChat" class="text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="chat-box" x-ref="chatBox">
                <template x-for="(message, index) in messages" :key="index">
                    <div :class="`message ${message.type === 'user' ? 'user-message' : 'ai-message'}`">
                        <span x-text="message.content"></span>
                    </div>
                </template>
                
                <div class="typing-indicator" x-show="isTyping">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="chat-input">
                <input 
                    type="text" 
                    x-model="userInput"
                    @keyup.enter="sendMessage"
                    placeholder="Nhập tin nhắn..."
                    :disabled="isTyping || !apiKey"
                >
                <button 
                    @click="sendMessage"
                    :disabled="isTyping || !userInput.trim() || !apiKey"
                >
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Alpine.js Chat Widget Logic -->
    <script>
      document.addEventListener('alpine:init', () => {
    Alpine.data('chatWidget', () => ({
        isOpen: false,
        messages: [{
            type: 'ai',
            content: 'Xin chào! Tôi là Travel Assistant, tôi có thể giúp đỡ gì được cho bạn?'
        }],
        userInput: '',
        isTyping: false,
        apiKey: 'AIzaSyC4Y5-QbOEP84NbdDs7dnOUfQwVG2BN-w0',

        async sendMessage() {
            if (!this.userInput.trim() || this.isTyping) return;

            const userMessage = this.userInput.trim();
            this.messages.push({
                type: 'user',
                content: userMessage
            });

            this.userInput = '';
            this.isTyping = true;
            this.scrollToBottom();

            try {
                // Thêm context về du lịch vào prompt
                const travelContext = `Bạn là một chuyên gia tư vấn du lịch với kiến thức sâu rộng về:
                - Các điểm du lịch nổi tiếng và địa điểm thú vị trên khắp thế giới
                - Văn hóa và phong tục địa phương
                - Ẩm thực đặc trưng của từng vùng miền
                - Kinh nghiệm lập kế hoạch du lịch và các mẹo hữu ích
                - Thông tin về khách sạn, phương tiện di chuyển
                - Các hoạt động giải trí và trải nghiệm địa phương
                - Ngân sách và chi phí du lịch
                - An toàn và các lưu ý khi du lịch
                
                Hãy trả lời câu hỏi sau một cách chi tiết và hữu ích nhất: ${userMessage}`;

                const response = await fetch(`https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=${this.apiKey}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        contents: [{
                            parts: [{
                                text: travelContext
                            }]
                        }],
                        generationConfig: {
                            temperature: 0.7,
                            topK: 40,
                            topP: 0.95,
                            maxOutputTokens: 1024,
                        },
                        safetySettings: [
                            {
                                category: "HARM_CATEGORY_HARASSMENT",
                                threshold: "BLOCK_MEDIUM_AND_ABOVE"
                            },
                            {
                                category: "HARM_CATEGORY_HATE_SPEECH",
                                threshold: "BLOCK_MEDIUM_AND_ABOVE"
                            }
                        ]
                    })
                });

                const data = await response.json();
                
                if (data.error) {
                    throw new Error(data.error.message);
                }

                const aiResponse = data.candidates[0].content.parts[0].text;
                this.messages.push({
                    type: 'ai',
                    content: aiResponse
                });
            } catch (error) {
                console.error('Error:', error);
                this.messages.push({
                    type: 'ai',
                    content: 'Xin lỗi, đã có lỗi xảy ra. Vui lòng thử lại sau.'
                });
            } finally {
                this.isTyping = false;
                this.scrollToBottom();
            }
        },

        toggleChat() {
            this.isOpen = !this.isOpen;
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const chatBox = this.$refs.chatBox;
                chatBox.scrollTop = chatBox.scrollHeight;
            });
        }
    }));
});

    </script>

    @yield('scripts')

    <!-- Toast Notification -->
    <div id="toast"
        class="fixed top-4 right-4 p-4 rounded-lg shadow-lg hidden"
        style="z-index: 9999;">
        <div class="flex items-center">
            <span id="toastMessage" class="text-white"></span>
        </div>
    </div>

    <!-- Toast JavaScript -->
    <script>
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');

            toastMessage.textContent = message;
            toast.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;

            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }
    </script>

    <!-- Error Handling -->
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                html: `
                    <div class="flex flex-col gap-2 w-full text-xs">
                        <div class="flex items-center justify-start w-[320px] bg-[#EF665B] p-3 rounded-lg shadow-md font-sans">
                            <div class="w-5 h-5 mr-2 -translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none">
                                                                        <path fill="#ffffff" d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"/>
                                </svg>
                            </div>
                            <div class="text-white">{{ session('error') }}</div>
                        </div>
                    </div>
                `,
                showConfirmButton: false,
                timer: 3000,
                background: 'transparent',
                backdrop: 'none',
                customClass: {
                    popup: '!bg-transparent !shadow-none'
                }
            });
        });
    </script>
    @endif

    <!-- Success Message -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                html: `
                    <div class="flex flex-col gap-2 w-full text-xs">
                        <div class="flex items-center justify-start w-[320px] bg-[#4CAF50] p-3 rounded-lg shadow-md font-sans">
                            <div class="w-5 h-5 mr-2 -translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none">
                                    <path fill="#ffffff" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                            </div>
                            <div class="text-white">{{ session('success') }}</div>
                        </div>
                    </div>
                `,
                showConfirmButton: false,
                timer: 3000,
                background: 'transparent',
                backdrop: 'none',
                customClass: {
                    popup: '!bg-transparent !shadow-none'
                }
            });
        });
    </script>
    @endif

    <!-- Additional Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
