import config from "./config.js";
const token = config.TMDB_API_TOKEN_KEY;


let currentPage = 1;
const moviesPerPage = 8;
let totalMovies = 0;

const options = {
    method: 'GET',
    headers: {
        accept: 'application/json',
        Authorization: `Bearer ${token}`
    }
};

document.getElementById('prev-button').addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        fetchMovies(currentPage);
    }
});

document.getElementById('next-button').addEventListener('click', () => {
    const totalPages = Math.ceil(totalMovies / moviesPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        fetchMovies(currentPage);
    }
});



/* FILTRAR POR PELICULAS DE API.THEMOVIEDB.ORG */

document.getElementById('search-input').addEventListener('input', filterMovies);

function filterMovies() {
    const searchQuery = document.getElementById('search-input').value.toLowerCase();
    const movies = JSON.parse(sessionStorage.getItem('feat_cont_movies')) || [];

    if (!searchQuery) {
        renderMovies(movies);
        return;
    }

    const filteredMovies = movies.filter(movie => {
        const title = movie.original_title.toLowerCase();
        return title.includes(searchQuery);
    });  

    renderMovies(filteredMovies);    
}

document.getElementById('search-input-best').addEventListener('input', filterBestMovies);

function filterBestMovies() {
    const searchQuery = document.getElementById('search-input-best').value.toLowerCase();
    const bestMovies = JSON.parse(sessionStorage.getItem('best_cont_movies')) || [];

    if (!searchQuery) {
        renderBestMovies(bestMovies);
        return;
    }

    const filteredBestMovies = bestMovies.filter(movie => {
        const title = movie.original_title.toLowerCase();
        return title.includes(searchQuery);
    });

    renderBestMovies(filteredBestMovies);
}


function renderMovies(movies) {
    const featuredContainer = document.querySelector(".featured-container");
    featuredContainer.innerHTML = "";

    movies.forEach(movie => {
        const movieItem = document.createElement("li");
        movieItem.classList.add("item");

        if (movie.backdrop_path) {
            movieItem.style.backgroundImage = `url(https://image.tmdb.org/t/p/w500${movie.poster_path})`;
        } else {
            movieItem.style.backgroundImage = `url('./assets/img/bg-banner.jpg')`;
        }

        const title = document.createElement("span");
        title.classList.add("title");
        title.textContent = movie.original_title;

        movieItem.appendChild(title);
        featuredContainer.appendChild(movieItem);
    });
}


function renderBestMovies(movies) {
    const bestContainer = document.querySelector(".best-container");
    bestContainer.innerHTML = "";

    movies.forEach(movie => {
        const movieItem = document.createElement("li");
        movieItem.classList.add("item");

        if (movie.backdrop_path) {
            movieItem.style.backgroundImage = `url(https://image.tmdb.org/t/p/w500${movie.poster_path})`;
        } else {
            movieItem.style.backgroundImage = `url('./assets/img/bg-banner.jpg')`;
        }

        const title = document.createElement("span");
        title.classList.add("title");
        title.textContent = movie.original_title;

        movieItem.appendChild(title);
        bestContainer.appendChild(movieItem);
    });
}



async function fetchMovies(pageNumber) {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=${pageNumber}&sort_by=popularity.desc`, options);
        const data = await response.json();


        // Guardar los datos en el sessionStorage
        sessionStorage.setItem('feat_cont_movies', JSON.stringify(data.results));

        totalMovies = data.total_results;
        const movies = data.results;
        const featuredContainer = document.querySelector(".featured-container");
        featuredContainer.innerHTML = "";

        movies.forEach(movie => {
            const movieItem = document.createElement("li");
            movieItem.classList.add("item");

            if (movie.backdrop_path) {
                movieItem.style.backgroundImage = `url(https://image.tmdb.org/t/p/w500${movie.poster_path})`;
            } else {
                movieItem.style.backgroundImage = `url('./assets/img/bg-banner.jpg')`;
            }

            const title = document.createElement("span");
            title.classList.add("title");
            title.textContent = movie.original_title;

            movieItem.appendChild(title);
            featuredContainer.appendChild(movieItem);
        });

    } catch (err) {
        console.error('Error:', err);
    }
}


async function fetchTopRated() {
    try {
        const response = await fetch('https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1', options);
        const data = await response.json();

        // Guardar los datos en el sessionStorage
        sessionStorage.setItem('best_cont_movies', JSON.stringify(data.results));
        
        const TopMovies = data.results;
        const bestContainer = document.querySelector(".best-container");
        
        TopMovies.forEach(movie => {
            const movieItem = document.createElement("li");
            movieItem.classList.add("item");
            
            if (movie.poster_path) {
                movieItem.style.backgroundImage = `url(https://image.tmdb.org/t/p/w500${movie.poster_path})`;
            } else {
                movieItem.style.backgroundImage = `url('./assets/img/bg-banner.jpg')`;
            }
            
            const title = document.createElement("span");
            title.classList.add("title");
            title.textContent = movie.original_title;
            
            movieItem.appendChild(title);
            bestContainer.appendChild(movieItem);
        });
    } catch (err) {
        console.error('Error:', err);
    }
}

fetchMovies(currentPage);
fetchTopRated();
