let liked = document.querySelector('.liked')
let disliked = document.querySelector('.disliked')
let satisfaction = document.querySelector('.satisfaction');
let id = document.querySelector('.liked').alt;

liked.addEventListener("click", likeLocation)
disliked.addEventListener("click", dislikeLocation)

function likeLocation() {
    fetch('/liked?id=' + id)
        .then(response => response.json())
        .then(satisfaction => console.log(satisfaction))
    liked.classList.add('likedSelected');
    disliked.classList.remove('dislikedSelected');
    satisfaction.classList.remove('liked');
    satisfaction.classList.remove('disliked');
    liked.removeEventListener("click", likeLocation)
    disliked.removeEventListener("click", dislikeLocation)
};

function dislikeLocation() {
    fetch('/disliked?id=' + id)
        .then(response => response.json())
        .then(satisfaction => console.log(satisfaction))
    disliked.classList.add('dislikedSelected');
    liked.classList.remove('likedSelected');
    satisfaction.classList.remove('liked');
    satisfaction.classList.remove('disliked');
    liked.removeEventListener("click", likeLocation)
    disliked.removeEventListener("click", dislikeLocation)

};
