function liked() {
    let liked = document.querySelector('.liked')
    let satisfaction = document.querySelector('.satisfaction');
    let id = document.querySelector('.liked').alt;

    liked.addEventListener("click", function () {
        fetch('/liked?id=' + id)
            .then(response => response.json())
            .then(satisfaction => console.log(satisfaction))
        liked.classList.add('likedSelected');
        satisfaction.classList.remove('liked');
        satisfaction.classList.remove('disliked');
    });
}

function dislike() {
    let disliked = document.querySelector('.disliked')
    let satisfaction = document.querySelector('.satisfaction');
    let id = document.querySelector('.liked').alt;

    disliked.addEventListener("click", function () {
        fetch('/disliked?id=' + id)
            .then(response => response.json())
            .then(satisfaction => console.log(satisfaction))
        disliked.classList.add('dislikedSelected');
        satisfaction.classList.remove('liked');
        satisfaction.classList.remove('disliked');
    });
}

liked();
dislike();