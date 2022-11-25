function updateText(overview, picture) {
    document.getElementById('description').innerHTML = overview;
    document.getElementById('image').setAttribute('src', 'https://www.themoviedb.org/t/p/w300_and_h450_bestv2' + picture);

}


fetch('/api/connect')
    .then(response => response.json())
    .then(connexion => {
        fetch('/api')
            .then(response => response.json())
            .then(movieSelected => {
                fetch('https://api.themoviedb.org/3/search/movie?api_key=' + connexion + '&query=' + movieSelected['movie_name'])
                    .then(response => response.json())
                    .then(movie => updateText(movie['results'][0]['overview'], movie['results'][0]['poster_path']))
                    .catch(() => alert('error 1'))
            }
            )
            .catch(() => alert('error 2'))
    })
