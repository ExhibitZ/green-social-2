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