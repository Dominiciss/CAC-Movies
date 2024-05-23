import config from "./config.js";
const token = config.TMDB_API_TOKEN_KEY;
const dropdown = document.querySelector("header nav .dropdown")
const sections = document.querySelectorAll(".fade")

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

async function fetchMovies(pageNumber) {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=${pageNumber}&sort_by=popularity.desc`, options);
        const data = await response.json();

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
                movieItem.style.backgroundImage = `url('img/bg-banner.jpg')`;
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

fetchMovies(currentPage);


async function fetchTopRated() {
    try {
        const response = await fetch('https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1', options);
        const data = await response.json();

        const TopMovies = data.results;
        const bestContainer = document.querySelector(".best-container");

        TopMovies.forEach(movie => {
            const movieItem = document.createElement("li");
            movieItem.classList.add("item");

            if (movie.poster_path) {
                movieItem.style.backgroundImage = `url(https://image.tmdb.org/t/p/w500${movie.poster_path})`;
            } else {
                movieItem.style.backgroundImage = `url('path/to/default/image.jpg')`;
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

fetchTopRated();


dropdown.addEventListener("click", (e) => {
    const menu = e.target.parentNode.querySelector(".right")
    if (menu.style.opacity == "1") {
        menu.classList.remove("open")
        menu.classList.add("close")
        setTimeout(() => {
            if (menu.classList.contains("close")) {
                menu.classList.remove("close")
                menu.style.opacity = "0"
            }
        }, 400)
    } else {
        menu.classList.remove("close")
        menu.classList.add("open")
        menu.style.opacity = "1"
    }
});

const isInView = (element) => {
    const rect = element.getBoundingClientRect();

    return (
        rect.bottom > 0 &&
        rect.top < (window.innerHeight || document.documentElement.clientHeight)
    );
};

const toggleNavbar = (element) => {
    const rect = element.getBoundingClientRect();

    return (
        rect.bottom > 0 &&
        rect.top < 0.1
    );
};

document.addEventListener("scroll", () => {
    sections.forEach(section => {
        if (isInView(section)) {
            section.classList.add("fade-in")
        }
    });
});
