//const featured = document.querySelector("section.featured .featured-container")
//const best = document.querySelector("section.best .best-container")
const dropdown = document.querySelector("header nav .dropdown")
const sections = document.querySelectorAll(".fade")

/*Conexion con API the movideDB*/

const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjZjg1ZjA1YzMzYmQ4N2UyYjNhYzZhZTljY2Q1ZDIzMyIsInN1YiI6IjY2NGRkZjdhNTE5NTYwMmQ0YjQzY2Q1NCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6VPi2NHafgsMnKOggFX4w6u0toowpwUnUdMa05a5MQI'
    }
  };
//Asignamos que arrancamos en la pagina 1
  let currentPage = 1;
  //Traemos las tendencias de hoy
  async function fetchMovie(pageNumber) {
    try {
        const response = await fetch(`https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=${pageNumber}&sort_by=popularity.desc`, options);
        const data = await response.json();

        // Aquí extraemos los resultados
        const movies = data.results;
        const featuredContainer = document.querySelector(".featured-container");
        //Borramos los containers para que en cada pagina arranquen vacios
        featuredContainer.innerHTML = "";
        // Iteramos sobre cada película y creamos elementos HTML
        movies.forEach(movie => {
            const movieItem = document.createElement("li");
            movieItem.classList.add("item");
            // Traemos la imagen sino
            if (movie.backdrop_path) {
                movieItem.style.backgroundImage = `url(https://image.tmdb.org/t/p/w500${movie.poster_path})`;
            } else {
                movieItem.style.backgroundImage = `url('img/bg-banner.jpg')`;
            }
            // Crea un span para el título de la película
            const title = document.createElement("span");
            title.classList.add("title");
            title.textContent = movie.original_title;

            // Añade el título al elemento de lista
            movieItem.appendChild(title);

            // Añade el elemento de lista a la lista destacada
            featuredContainer.appendChild(movieItem);
        });

    } catch (err) {
        console.error('Error:', err);
    }
}

fetchMovie(currentPage)

// Función para cargar la siguiente página
function nextPage() {
    currentPage++;
    fetchMovie(currentPage);
}

// Función para cargar la página anterior 
function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        fetchMovie(currentPage);
    }
}


//Traemos las peliculas mas aclamadas
async function fetchTopRated() {
    try {
        const response = await fetch('https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1', options)
        const data = await response.json();

        // Aquí extraemos los resultados
        const TopMovies = data.results;
        const bestContainer = document.querySelector(".best-container");

        TopMovies.forEach(movie => {
            const movieItem = document.createElement("li");
            movieItem.classList.add("item");

            if (movie.poster_path) {
                movieItem.style.backgroundImage = `url(https://image.tmdb.org/t/p/w500${movie.poster_path})`;
            } else {
                movieItem.style.backgroundImage = `url('path/to/default/image.jpg')`; // Imagen por defecto si no hay fondo
            }
            // Crea un span para el título de la película
            const title = document.createElement("span");
            title.classList.add("title");
            title.textContent = movie.original_title;

            // Añade el título al elemento de lista
            movieItem.appendChild(title);

            // Añade el elemento de lista a la lista destacada
            bestContainer.appendChild(movieItem);
        });
    } catch (err) {
        console.error('Error:', err);
    }
}

fetchTopRated();

/*for (let i = 0; i <19; i++) {
    //const titles = ["The Beekeeper", "Badland Hunters", "The Marvels", "Wonka", "Aquaman and the Lost Kingdom", "Migration", "Sixty Minutes", "Wish", "The Masked Saint", "Due Justice", "Orion and the Dark", "Genghis Khan", "Lift", "Attack", "Mutant Ghost Wargirl", "Poor Things", "The 5", "Truck: Locked in", "Anyone but you"]
    const titles=i;
    const movie = document.createElement("li")
    const title = document.createElement("span")
    movie.classList.add("item")
    movie.style.backgroundImage = `url("./assets/img/movies/peli_${i + 1}.jpg`
    title.classList.add("title")
    title.innerHTML = titles[i]
    movie.appendChild(title)
    featured.appendChild(movie)
}

for (let i = 0; i < 12; i++) {
    const titles = ["The Shawshank Redemption", "The Godfather", "The Godfather II", "Schindler's List", "12 Angry Men", "Spirited Away", "The Dark Knight", "The Green Mile", "Parasite", "Forrest Gump", "Pulp Fiction", "The Lord of the Rings: The Return of the King"]
    const movie = document.createElement("li")
    const title = document.createElement("span")
    movie.classList.add("item")
    movie.style.backgroundImage = `url("./assets/img/movies/aclamada_${i + 1}.jpg`
    title.classList.add("title")
    title.innerHTML = titles[i]
    movie.appendChild(title)
    best.appendChild(movie)
}*/

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
})

const isInView = (element) => {
    const rect = element.getBoundingClientRect();

    return (
        rect.bottom > 0 &&
        rect.top < (window.innetHeight || document.documentElement.clientHeight)
    )
}

const toggleNavbar = (element) => {
    const rect = element.getBoundingClientRect();

    return (
        rect.bottom > 0 &&
        rect.top < 0.1
    )
}

document.addEventListener("scroll", () => {
    sections.forEach(section => {
        if (isInView(section)) {
            section.classList.add("fade-in")
        }
    })
})