
const selectAnswer = document.getElementsByName('answer'); //selectionne les réponses

function color() {
    for (let i = 0; i <= 3; i++) {
        selectAnswer[i].parentNode.classList.remove('buttonQuiz');
    }
}

for (let y = 0; y <= 3; y++) {

    selectAnswer[y].addEventListener('click', function () {
        color();

        this.parentNode.classList.add('buttonQuiz');
        console.log("toto");
    });
}