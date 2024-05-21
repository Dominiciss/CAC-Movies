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
        date.parentNode.querySelector(".error").classList.add("hidden")
    } else {
        date.classList.remove("valid")
    }
})

document.querySelector(".input-country").addEventListener("change", (e) => {
    const country = e.target
    if (country.value != "" && country.value != " " && country.value != null && country.value != undefined) {
        country.classList.add("valid")
        country.parentNode.querySelector(".error").classList.add("hidden")
    } else {
        country.classList.remove("valid")
    }
})

document.querySelector(".register").addEventListener("submit", (e) => {
    e.preventDefault()
    const [ name, surname, email, password1, password2, date, country, terms ] = Array.from(e.target.querySelectorAll(".input-data")).map((input) => input);

    if (name.value == "" || name.value == undefined || name.value == null || name.value == " " || !/[a-z]{2,}/i.test(name.value)) {
        name.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (surname.value == "" || surname.value == undefined || surname.value == null || surname.value == " " || !/[a-z]{2,}/i.test(surname.value)) {
        surname.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (email.value == "" || email.value == undefined || email.value == null || email.value == " " || !/([a-zA-Z0-9]+[@][a-zA-Z]+)[.][a-zA-Z0-9]+/.test(email.value)) {
        email.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (password1.value == "" || password1.value == undefined || password1.value == null || password1.value == " " || !/[a-z0-9]{4,}/i.test(password1.value)) {
        password1.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (password2.value == "" || password2.value == undefined || password2.value == null || password2.value == " " || !/[a-z0-9]{4,}/i.test(password2.value)) {
        password2.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (date.value == "" || date.value == undefined || date.value == null || date.value == " ") {
        date.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (country.value == "" || country.value == undefined || country.value == null || country.value == " ") {
        country.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (terms.checked == false) {
        terms.parentNode.querySelector(".error").classList.remove("hidden")
    }
})

document.querySelectorAll("input").forEach((input) => input.addEventListener("input", (e) => e.target.parentNode.querySelector(".error").classList.add("hidden")))