/* jshint esversion: 8 */
setTimeout(() => document.querySelector("body>div").innerHTML = "", 100)

let currentPage = 1
const moviesPerPage = 8
let totalMovies = 0

const featuredContainer = document.querySelector(".featured-container")

document.getElementById('prev-button').addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--
        fetchMovies(currentPage)
    }
})

document.getElementById('next-button').addEventListener('click', () => {
    const totalPages = Math.ceil(totalMovies / moviesPerPage)
    if (currentPage < totalPages) {
        currentPage++
        fetchMovies(currentPage)
    }
})

document.getElementById("logout")?.addEventListener("click", async (e) => {
    const response = await fetch("./assets/php/logout.php", {
        method: 'POST',
    })

    if (response.ok) {
        Swal.fire({
            title: '¡Usted se ha deslogueado con exito!',
            text: '¡Adios!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            location.replace("./")
        })
    } else {
        Swal.fire({
            title: 'Error',
            text: 'Pruebe a desloguearse nuevamente',
            icon: 'error',
            confirmButtonText: 'OK'
        })
    }
})

async function fetchMovies(pageNumber) {
    const response = await fetch("./../assets/php/get_movies.php", {
        method: 'GET'
    })
    const data = await response.json()

    data.forEach(async movie => {
        const movieItem = document.createElement("li")
        movieItem.classList.add("item")

        let formData = new FormData()

        formData.append("id", movie[6])

        const _response = await fetch("./../assets/php/get_movie_image.php", {
            method: 'POST',
            body: formData
        })
        const _data = await _response.text()
        movieItem.style.backgroundImage = `url(${_data})`

        const title = document.createElement("span")
        title.classList.add("title")
        title.textContent = movie[1]

        movieItem.appendChild(title)
        featuredContainer.appendChild(movieItem)
    })
}

fetchMovies(currentPage)


// async function fetchTopRated() {
//     try {
//         const response = await fetch('https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1', options)
//         const data = await response.json()

//         const TopMovies = data.results
//         const bestContainer = document.querySelector(".best-container")

//         TopMovies.forEach(movie => {
//             const movieItem = document.createElement("li")
//             movieItem.classList.add("item")

//             if (movie.poster_path) {
//                 movieItem.style.backgroundImage = `url(https://image.tmdb.org/t/p/w500${movie.poster_path})`
//             } else {
//                 movieItem.style.backgroundImage = `url('./assets/img/bg-banner.jpg')`
//             }

//             const title = document.createElement("span")
//             title.classList.add("title")
//             title.textContent = movie.original_title

//             movieItem.appendChild(title)
//             bestContainer.appendChild(movieItem)
//         })
//     } catch (err) {
//         console.error('Error:', err)
//     }
// }

// fetchTopRated()
