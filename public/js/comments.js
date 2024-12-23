document.addEventListener('DOMContentLoaded', function() {
    const commentsSection = document.querySelector('.comments-section');
    const commentForm = document.querySelector('.comment-form');
    const postId = document.querySelector('.comments-container').dataset.postId;

    // Load comments when page loads
    loadComments();

    // Handle comment submission
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const content = this.querySelector('input[name="content"]').value;
            submitComment(content);
        });
    }

    function loadComments() {
        fetch(`/comments?post_id=${postId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayComments(data.comments);
                }
            })
            .catch(error => console.error('Error loading comments:', error));
    }

    function submitComment(content, parentId = null) {
        fetch('/comments', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                post_id: postId,
                content: content,
                parent_id: parentId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                commentForm.querySelector('input[name="content"]').value = '';
                loadComments(); // Reload all comments
            }
        })
        .catch(error => console.error('Error submitting comment:', error));
    }

    function displayComments(comments) {
        commentsSection.innerHTML = comments.map(comment => createCommentHTML(comment)).join('');
        
        // Add event listeners for reply, edit, and delete buttons
        addCommentEventListeners();
    }

    function createCommentHTML(comment) {
        const isOwner = currentUserId === comment.user_id;
        const actions = isOwner ? `
            <button class="edit-comment text-blue-500 text-sm" data-comment-id="${comment.id}">Sửa</button>
            <button class="delete-comment text-red-500 text-sm" data-comment-id="${comment.id}">Xóa</button>
        ` : '';

        return `
            <div class="comment bg-white p-4 rounded-lg shadow-sm" data-comment-id="${comment.id}">
                <div class="flex items-start space-x-3">
                    <img src="${comment.user.avatar}" alt="${comment.user.name}" class="w-8 h-8 rounded-full">
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="font-semibold">${comment.user.name}</h4>
                            <div class="space-x-2">
                                ${actions}
                            </div>
                        </div>
                        <p class="mt-1">${comment.content}</p>
                        <div class="mt-2 text-sm text-gray-500">
                            <button class="reply-button" data-comment-id="${comment.id}">Trả lời</button>
                            · ${new Date(comment.created_at).toLocaleDateString()}
                        </div>
                    </div>
                </div>
                ${comment.replies ? comment.replies.map(reply => `
                    <div class="reply ml-10 mt-3 bg-gray-50 p-3 rounded">
                        ${createCommentHTML(reply)}
                    </div>
                `).join('') : ''}
            </div>
        `;
    }

    function addCommentEventListeners() {
        // Reply buttons
        document.querySelectorAll('.reply-button').forEach(button => {
            button.addEventListener('click', function() {
                const commentId = this.dataset.commentId;
                const commentElement = this.closest('.comment');
                
                // Remove any existing reply forms
                document.querySelectorAll('.reply-form').forEach(form => form.remove());
                
                // Create and insert reply form
                const replyForm = createReplyForm(commentId);
                commentElement.appendChild(replyForm);
            });
        });

        // Edit buttons
        document.querySelectorAll('.edit-comment').forEach(button => {
            button.addEventListener('click', function() {
                const commentId = this.dataset.commentId;
                const commentElement = this.closest('.comment');
                const commentContent = commentElement.querySelector('p').textContent;
                
                // Replace content with edit form
                const editForm = createEditForm(commentId, commentContent);
                commentElement.querySelector('p').replaceWith(editForm);
            });
        });

        // Delete buttons
        document.querySelectorAll('.delete-comment').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Bạn có chắc muốn xóa bình luận này?')) {
                    const commentId = this.dataset.commentId;
                    deleteComment(commentId);
                }
            });
        });
    }

    function createReplyForm(parentId) {
        const form = document.createElement('form');
        form.className = 'reply-form mt-3 ml-10';
        form.innerHTML = `
            <div class="flex gap-2">
                <input type="text" 
                       placeholder="Viết trả lời..." 
                       class="flex-1 bg-gray-100 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                <button type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors">
                    Gửi
                </button>
            </div>
        `;

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const content = this.querySelector('input').value;
            submitComment(content, parentId);
            this.remove();
        });

        return form;
    }

    function createEditForm(commentId, content) {
        const form = document.createElement('form');
        form.className = 'edit-form mt-2';
        form.innerHTML = `
            <div class="flex gap-2">
                <input type="text" 
                       value="${content}" 
                       class="flex-1 bg-gray-100 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                <button type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors">
                    Lưu
                </button>
            </div>
        `;

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const newContent = this.querySelector('input').value;
            updateComment(commentId, newContent);
        });

        return form;
    }

    function updateComment(commentId, content) {
        fetch(`/comments/${commentId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ content })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadComments();
            }
        })
        .catch(error => console.error('Error updating comment:', error));
    }

    function deleteComment(commentId) {
        fetch(`/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadComments();
            }
        })
        .catch(error => console.error('Error deleting comment:', error));
    }
});
