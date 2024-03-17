const featured = document.querySelector("section.featured .featured-container")
const best = document.querySelector("section.best .best-container")
const dropdown = document.querySelector("header nav .dropdown")

for (let i = 0; i < 19; i++) {
    const titles = ["The Beekeeper", "Badland Hunters", "The Marvels", "Wonka", "Aquaman and the Lost Kingdom", "Migration", "Sixty Minutes", "Wish", "The Masked Saint", "Due Justice", "Orion and the Dark", "Genghis Khan", "Lift", "Attack", "Mutant Ghost Wargirl", "Poor Things", "The 5", "Truck: Locked in", "Anyone but you"]
    const movie = document.createElement("li")
    const title = document.createElement("span")
    movie.classList.add("item")
    movie.style.backgroundImage = `url("../CAC-Movies/assets/img/movies/peli_${i + 1}.jpg`
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
    movie.style.backgroundImage = `url("../CAC-Movies/assets/img/movies/aclamada_${i + 1}.jpg`
    title.classList.add("title")
    title.innerHTML = titles[i]
    movie.appendChild(title)
    best.appendChild(movie)
}

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