
const selectAnswer = document.getElementsByName('answer'); //selectionne les réponses
const selectClass = document.getElementsByClassName('buttonGuessr');

function color() {
    for (let i = 0; i <= 3; i++) {
        selectAnswer[i].parentNode.classList.remove('buttonQuiz');
        selectClass[i].classList.remove('buttonQuiz');
    }
}

for (let y = 0; y <= 3; y++) {

    selectAnswer[y].addEventListener('click', function () {
        color();

        this.parentNode.classList.add('buttonQuiz');
    });
}


for (let y = 0; y <= 3; y++) {

    selectClass[y].addEventListener('click', function () {
        color();

        this.classList.add('buttonQuiz');
        console.log("toto");
    });
}