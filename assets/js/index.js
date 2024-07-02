/* jshint esversion: 8 */
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
            window.location = "./"
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

const setMoviesLength = async () => {
    const response = await fetch('./../assets/php/get_movies_length.php', {
        method: 'GET'
    })
    const data = await response.text()
    totalMovies = data

    validateButtons()
}

let currentPage = 1
const moviesPerPage = 8
let totalMovies = 0
setMoviesLength()

const featuredContainer = document.querySelector(".featured-container")
const bestContainer = document.querySelector(".best-container")

const validateButtons = () => {
    const prevButton = document.getElementById('prev-button')
    const nextButton = document.getElementById('next-button')
    const totalPages = Math.ceil(totalMovies / moviesPerPage)

    if (currentPage <= 1) {
        prevButton.classList.add("disabled")
    } else if (prevButton.classList.contains("disabled")) {
        prevButton.classList.remove("disabled")
    }

    if (currentPage >= totalPages) {
        nextButton.classList.add("disabled")
    } else if (nextButton.classList.contains("disabled")) {
        nextButton.classList.remove("disabled")
    }
}

document.getElementById('prev-button').addEventListener('click', (e) => {
    if (currentPage > 1) {
        currentPage--
        fetchMovies(currentPage)
    }
    validateButtons()
})

document.getElementById('next-button').addEventListener('click', () => {
    const totalPages = Math.ceil(totalMovies / moviesPerPage)
    if (currentPage < totalPages) {
        currentPage++
        fetchMovies(currentPage)
    }
    validateButtons()
})

function loading(container, length = moviesPerPage) {
    for (let i = 0; i < length; i++) {
        const movieItem = document.createElement("li")
        movieItem.classList.add("item")

        const spinner = document.createElement("div")
        spinner.classList.add("loader")

        movieItem.appendChild(spinner)

        container.appendChild(movieItem)
    }
}

async function fetchMovies(pageNumber) {
    featuredContainer.innerHTML = ""
    loading(featuredContainer)

    const response = await fetch(`./../assets/php/get_movies.php?page=${pageNumber}`, {
        method: 'GET'
    })
    const data = await response.json()

    data.forEach(async (movie, index) => {
        const movieItem = featuredContainer.querySelectorAll("li.item")[index]
        movieItem.querySelector(".loader").remove()
        movieItem.addEventListener("click", (e) => { window.location = `./pages/movie.php?id=${movie[0]}` })

        let formData = new FormData()

        formData.append("id", movie[6])

        const _response = await fetch("./../assets/php/get_movie_image.php", {
            method: 'POST',
            body: formData
        })
        const _data = await _response.text()
        movieItem.style.backgroundImage = `url(${_data})`

        const info = document.createElement("information")
        info.classList.add("information")

        const title = document.createElement("span")
        title.classList.add("title")
        title.textContent = movie[1]

        const director = document.createElement("span")
        director.classList.add("director")
        director.textContent = movie[2]

        const rating = document.createElement("span")
        rating.classList.add("rating")
        rating.textContent = movie[4] + "⭐"

        info.appendChild(title)
        info.appendChild(director)
        info.appendChild(rating)

        movieItem.appendChild(info)
    })

    featuredContainer.querySelectorAll(".item:has(.loader)").forEach((e) => { e.remove() })
}

fetchMovies(currentPage)


async function fetchTopRated() {
    loading(bestContainer, 12)

    const response = await fetch('./../assets/php/get_top_rated_movies.php', {
        method: 'GET'
    })
    const data = await response.json()

    data.forEach(async (movie, index) => {
        const movieItem = bestContainer.querySelectorAll("li.item")[index]
        movieItem.querySelector(".loader").remove()
        movieItem.addEventListener("click", (e) => { window.location = `./pages/movie.php?id=${movie[0]}` })

        let formData = new FormData()

        formData.append("id", movie[6])

        const _response = await fetch("./../assets/php/get_movie_image.php", {
            method: 'POST',
            body: formData
        })
        const _data = await _response.text()
        movieItem.style.backgroundImage = `url(${_data})`

        const info = document.createElement("information")
        info.classList.add("information")

        const title = document.createElement("span")
        title.classList.add("title")
        title.textContent = movie[1]

        const director = document.createElement("span")
        director.classList.add("director")
        director.textContent = movie[2]

        const rating = document.createElement("span")
        rating.classList.add("rating")
        rating.textContent = movie[4] + "⭐"

        info.appendChild(title)
        info.appendChild(director)
        info.appendChild(rating)

        movieItem.appendChild(info)
    })

    bestContainer.querySelectorAll(".item:has(.loader)").forEach((e) => { e.remove() })
}

fetchTopRated()
