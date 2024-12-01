// document.addEventListener("DOMContentLoaded", function() {
//     document.querySelectorAll('.like-button').forEach(button => {
//         button.addEventListener('click', function() {
//             let postId = this.getAttribute('data-post-id');
//             let likeCountElement = document.getElementById(`like-count-${postId}`);
//             let likeButton = document.getElementById(`like-${postId}`);

//             likeButton.classList.toggle('liked');

//             let likeCount = parseInt(likeCountElement.textContent);
//             likeCountElement.textContent = likeButton.classList.contains('liked') ? likeCount + 1 : likeCount - 1;

//             fetch(`/posts/${postId}/like`, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 },
//                 body: JSON.stringify({ like: likeButton.classList.contains('liked') })
//             });
//         });
//     });
// });

function likesClick(postId){
    let likeButton = document.getElementById("like-button-" + postId);
    let likeCount = document.getElementById("like-count-" + postId);

    likeButton.classList.toggle('liked');

    // update like count
    let likeCountNum = parseInt(likeCount.textContent);
    likeCount.textContent = likeButton.classList.contains('liked') ? likeCountNum + 1 : likeCountNum - 1;

    let url = "/posts/" + postId + "/like";
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    });
}