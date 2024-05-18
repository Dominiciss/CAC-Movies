const dropdown = document.querySelector("header nav .dropdown")

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

document.querySelector(".input-date").addEventListener("change", (e) => {
    const date = e.target
    if (date.value != "" && date.value != " " && date.value != null && date.value != undefined) {
        date.classList.add("valid")
    } else {
        date.classList.remove("valid")
    }
})

document.querySelector(".input-country").addEventListener("change", (e) => {
    const country = e.target
    if (country.value != "" && country.value != " " && country.value != null && country.value != undefined) {
        country.classList.add("valid")
    } else {
        country.classList.remove("valid")
    }
})