function sendMessage() {
    const userInput = document.getElementById('userInput');
    const chatBox = document.getElementById('chatBox');
    const message = userInput.value.trim();

    if (message !== '') {
        // Hiển thị tin nhắn của người dùng
        appendMessage('user', message);
        
        // Gọi API AI (ví dụ sử dụng OpenAI API)
        callAIAPI(message);
        
        // Xóa input
        userInput.value = '';
    }
}

function appendMessage(sender, message) {
    const chatBox = document.getElementById('chatBox');
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${sender}-message`;
    messageDiv.textContent = message;
    chatBox.appendChild(messageDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
}

async function callAIAPI(message) {
    try {
        const response = await fetch('https://api.openai.com/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer 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'
            },
            body: JSON.stringify({
                model: "gpt-3.5-turbo",
                messages: [{
                    role: "user",
                    content: message
                }]
            })
        });

        const data = await response.json();
        const aiResponse = data.choices[0].message.content;
        appendMessage('ai', aiResponse);
    } catch (error) {
        console.error('Error:', error);
        appendMessage('ai', 'Xin lỗi, đã có lỗi xảy ra.');
    }
}

function toggleChat() {
    const chatContainer = document.getElementById('chatContainer');
    if (chatContainer.style.display === 'none') {
        chatContainer.style.display = 'flex';
    } else {
        chatContainer.style.display = 'none';
    }
}

// Thêm vào phần head của HTML
// <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 