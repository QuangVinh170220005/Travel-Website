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

// Hàm thêm tin nhắn vào chat box
function appendMessage(sender, message) {
    const chatBox = document.getElementById('chatBox');
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${sender}-message`;
    messageDiv.textContent = message;
    chatBox.appendChild(messageDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
}