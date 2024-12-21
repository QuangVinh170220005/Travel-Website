import './bootstrap';
document.addEventListener('DOMContentLoaded', function() {
    // Lấy tất cả các button câu hỏi
    const questionButtons = document.querySelectorAll('.question-button');
    
    // Lấy tất cả các modal
    const modals = document.querySelectorAll('.modal');
    
    // Thêm sự kiện click cho mỗi button
    questionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('active');
            }
        });
    });
    
    // Thêm sự kiện đóng modal
    modals.forEach(modal => {
        // Đóng khi click nút close
        const closeBtn = modal.querySelector('.close-modal');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                modal.classList.remove('active');
            });
        }
        
        // Đóng khi click bên ngoài modal
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    });
});
// Hàm xử lý gửi tin nhắn đến AI
async function sendMessage() {
    const userInput = document.getElementById('userInput');
    const message = userInput.value.trim();
    const chatBox = document.getElementById('chatBox');

    if (message === '') return;

    // Hiển thị tin nhắn của người dùng
    appendMessage('user', message);
    
    // Hiển thị trạng thái đang xử lý
    const loadingDiv = document.createElement('div');
    loadingDiv.className = 'message ai-message loading';
    loadingDiv.textContent = 'Đang xử lý...';
    chatBox.appendChild(loadingDiv);

    try {
        const response = await fetch('https://api.openai.com/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer YOUR_API_KEY_HERE' // Thay YOUR_API_KEY_HERE bằng API key của bạn
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
        
        // Xóa loading message
        loadingDiv.remove();
        
        // Hiển thị phản hồi từ AI
        if (data.choices && data.choices.length > 0) {
            appendMessage('ai', data.choices[0].message.content);
        }

        // Clear input
        userInput.value = '';

    } catch (error) {
        console.error('Error:', error);
        loadingDiv.remove();
        appendMessage('ai', 'Xin lỗi, đã có lỗi xảy ra. Vui lòng thử lại sau.');
    }
}

// Hàm thêm tin nhắn vào chat box
function appendMessage(sender, message) {
    const chatBox = document.getElementById('chatBox');
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${sender}-message`;
    messageDiv.textContent = message;
    chatBox.appendChild(messageDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
}