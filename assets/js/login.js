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

document.querySelector(".login").addEventListener("submit", (e) => {
    e.preventDefault()
    const [ email, password ] = Array.from(e.target.querySelectorAll("input")).map((input) => input);

    if (email.value == "" || email.value == undefined || email.value == null || email.value == " " || !/([a-zA-Z0-9]+[@][a-zA-Z]+)[.][a-zA-Z0-9]+/.test(email.value)) {
        email.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (password.value == "" || password.value == undefined || password.value == null || password.value == " " || !/[a-z0-9]{4,}/i.test(password.value)) {
        password.parentNode.querySelector(".error").classList.remove("hidden")
    }
})

document.querySelectorAll("input").forEach((input) => input.addEventListener("input", (e) => e.target.parentNode.querySelector(".error").classList.add("hidden")))