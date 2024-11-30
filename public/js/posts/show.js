document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function() {
            let postId = this.getAttribute('data-post-id');
            let likeCountElement = document.getElementById(`like-count-${postId}`);
            let likeButton = document.getElementById(`like-${postId}`);

            likeButton.classList.toggle('liked');

            let likeCount = parseInt(likeCountElement.textContent);
            likeCountElement.textContent = likeButton.classList.contains('liked') ? likeCount + 1 : likeCount - 1;

            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ like: likeButton.classList.contains('liked') })
            });
        });
    });
});