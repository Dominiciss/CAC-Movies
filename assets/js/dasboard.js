
/* FILTRAR POR NOMBRE */
document.getElementById('buscar').addEventListener('input', filterMovies);

function filterMovies() {
    const searchQuery = document.getElementById('buscar').value.toLowerCase();
    const movieItems = document.querySelectorAll('.item-container .item');

    movieItems.forEach(item => {
        const title = item.querySelector('#title').textContent.toLowerCase();     
        const director = item.querySelector('#director').textContent.toLowerCase();
        const genre = item.querySelector('#genre').textContent.toLowerCase(); 

        if (title.includes(searchQuery) || director.includes(searchQuery) || genre.includes(searchQuery)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }        
    });
}
