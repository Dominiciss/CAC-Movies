/* jshint esversion: 8 */
document.getElementById("logout")?.addEventListener("click", async (e) => {
    const response = await fetch("./../assets/php/logout.php", {
        method: 'POST',
    })

    if (response.ok) {
        Swal.fire({
            title: '¡Usted se ha deslogueado con exito!',
            text: '¡Adios!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location = "./../"
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

document.querySelectorAll(".users_data .pie_selector>div").forEach((e, i, array) => {
    e.addEventListener("click", (e) => {
        e.target.parentNode.parentNode.querySelector('.wrapper .pie_container').style.transform = `translateY(${i * -100}%)`
        array.forEach((_e, _i) => {
            if (i == _i) {
                _e.classList.add("active")
            } else {
                _e.classList.remove("active")
            }
        })
    })
})

document.querySelectorAll(".movies_data .pie_selector>div").forEach((e, i, array) => {
    e.addEventListener("click", (e) => {
        e.target.parentNode.parentNode.querySelector('.wrapper .pie_container').style.transform = `translateY(${i * -100}%)`
        array.forEach((_e, _i) => {
            if (i == _i) {
                _e.classList.add("active")
            } else {
                _e.classList.remove("active")
            }
        })
    })
})

document.querySelectorAll(".users_section td .edit[type=button]").forEach((e) => {
    e.addEventListener("click", () => {
        e.hidden = true
        e.parentNode.parentNode.querySelector("button[type=submit]").hidden = false
        e.parentNode.parentNode.querySelector("button[type=reset]").hidden = false
        e.parentNode.parentNode.parentNode.querySelectorAll("input").forEach((e) => { e.disabled = false })
        e.parentNode.parentNode.parentNode.querySelectorAll("select").forEach((e) => { e.disabled = false })
    })
})

document.querySelectorAll(".users_section td button[type=reset]").forEach((e) => {
    e.addEventListener("click", () => {
        e.hidden = true
        e.parentNode.parentNode.querySelector("button[type=submit]").hidden = true
        e.parentNode.parentNode.parentNode.querySelectorAll("input").forEach((e) => { e.disabled = true })
        e.parentNode.parentNode.parentNode.querySelectorAll("select").forEach((e) => { e.disabled = true })
        e.parentNode.parentNode.querySelector("button[type=button]").hidden = false
    })
})

document.querySelectorAll(".users_section td button[type=submit]").forEach((e) => {
    e.parentNode.parentNode.parentNode.querySelector("form").addEventListener("submit", async (e) => {
        e.preventDefault()
        e.target.parentNode.querySelectorAll("input").forEach(e => e.disabled = true)
        e.target.parentNode.querySelectorAll("select").forEach(e => e.disabled = true)

        const id = e.target.parentNode.querySelector(".id").textContent
        const inputs = Array.from(e.target.parentNode.querySelectorAll("input"))
        const selects = Array.from(e.target.parentNode.querySelectorAll("select"))
        const [name, surname, email, date] = inputs
        const [country, role] = selects

        let formData = new FormData()

        formData.append('id', id)
        formData.append('name', name.value)
        formData.append('surname', surname.value)
        formData.append('email', email.value)
        formData.append('date', date.value)
        formData.append('country', country.value)
        formData.append('role', role.value)

        const response = await fetch("../assets/php/update.php", {
            method: 'POST',
            body: formData
        })

        if (response.ok) {
            Swal.fire({
                title: '¡Usted ha actualizado el usuario con exito!',
                text: '¡Gracias por usar nuestros servicios!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location = "./dashboard.php"
            })
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Pruebe nuevamente',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }
        e.target.parentNode.querySelectorAll("input").forEach(e => e.disabled = false)
        e.target.parentNode.querySelectorAll("select").forEach(e => e.disabled = true)
    })
})

document.querySelectorAll(".users_section td .delete[type=button]").forEach((e) => {
    e.addEventListener("click", async () => {
        const id = e.parentNode.parentNode.querySelector(".id").textContent

        let formData = new FormData()

        formData.append('id', id)

        if (confirm("Esta seguro que quiere remover este usuario?")) {
            const response = await fetch("../assets/php/delete.php", {
                method: 'POST',
                body: formData
            })

            if (response.ok) {
                Swal.fire({
                    title: '¡Usted ha removido al usuario con exito!',
                    text: '¡Gracias por usar nuestros servicios!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = "./dashboard.php"
                })
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Pruebe nuevamente',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            }
        }
    })
})

document.querySelectorAll(".movie_section .movie_form input").forEach((input) =>
    input.addEventListener("input", (e) => { e.target.parentNode.querySelector(".error").classList.add("hidden") })
)

document.querySelector(".create_movie").addEventListener("submit", async (e) => {
    e.preventDefault()

    const inputs = Array.from(e.target.querySelectorAll(".input-data"))
    const [file, title, director, genre, date, rating, description] = inputs

    let isValid = true

    isValid &= validateFile(file)
    isValid &= validateInput(title, /^[a-zA-Z0-9 ]{2,}$/i)
    isValid &= validateInput(director, /^[a-zA-Z ]{2,}$/i)
    isValid &= validateInput(genre, /^[a-zA-Z ]{2,}$/i)
    isValid &= validateInput(rating, /^[0-9.]{1,}$/i)
    isValid &= validateInput(date, /.+/)

    if (isValid) {
        let formData = new FormData()

        formData.append('file', file.files[0])
        formData.append('title', title.value)
        formData.append('director', director.value)
        formData.append('genre', genre.value)
        formData.append('rating', rating.value)
        formData.append('date', date.value)
        formData.append('description', description.value)

        const response = await fetch("../assets/php/create_movie.php", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        })

        if (response.ok) {
            const id = await response.text()
            Swal.fire({
                title: '¡Usted ha ingresado una pelicula con Éxito!',
                text: '¡Gracias por usar nuestros servicios!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location = `./movie.php?id=${id}`
            })
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Pruebe a registrar la pelicula nuevamente',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }
    }
})

function validateFile(input) {
    const isValid = input.files[0] != null
    if (!isValid) {
        input.parentNode.querySelector(".error").classList.remove("hidden")
    }
    return isValid
}

function validateInput(input, regex) {
    const isValid = regex.test(input.value.trim())
    if (!isValid) {
        input.parentNode.querySelector(".error").classList.remove("hidden")
    }
    return isValid
}

document.querySelector("#movie_file").addEventListener("change", (e) => {
    const files = e.currentTarget.files
    if (files != null && files[0] != null) {
        const file = files[0]
        const image = e.currentTarget.parentNode.querySelector("label img")
        const reader = new FileReader()

        reader.onload = (e) => {
            image.src = e.target?.result
        }
        e.target?.classList.remove("empty")

        reader.readAsDataURL(file)
    } else {
        console.error("Could not read file")
        e.currentTarget.value = ""
        e.target?.classList.add("empty")
    }
})

document.querySelector(".movie_section .movie_form .input-date").addEventListener("change", (e) => {
    const date = e.target
    if (date.value.trim() !== "") {
        date.classList.add("valid")
        date.parentNode.querySelector(".error").classList.add("hidden")
    } else {
        date.classList.remove("valid")
    }
})

document.querySelectorAll(".movie_table td .edit[type=button]").forEach((e) => {
    e.addEventListener("click", () => {
        e.hidden = true
        e.parentNode.parentNode.querySelector("button[type=submit]").hidden = false
        e.parentNode.parentNode.querySelector("button[type=reset]").hidden = false
        e.parentNode.parentNode.parentNode.querySelectorAll("input").forEach((e) => { e.disabled = false })
        e.parentNode.parentNode.parentNode.querySelectorAll("textarea").forEach((e) => { e.disabled = false })
        e.parentNode.parentNode.parentNode.querySelectorAll("input[type=file]~label").forEach((e) => { e.querySelector("a").classList.add("disabled") })
    })
})

document.querySelectorAll(".movie_table td button[type=reset]").forEach((e) => {
    e.addEventListener("click", () => {
        e.hidden = true
        e.parentNode.parentNode.querySelector("button[type=submit]").hidden = true
        e.parentNode.parentNode.parentNode.querySelectorAll("input").forEach((e) => { e.disabled = true })
        e.parentNode.parentNode.parentNode.querySelectorAll("textarea").forEach((e) => { e.disabled = true; e.removeAttribute("style") })
        e.parentNode.parentNode.parentNode.querySelectorAll("input[type=file]~label").forEach((e) => {
            const a = e.querySelector("a")
            a.classList.remove("disabled")
            a.textContent = a.getAttribute("text")
        })
        e.parentNode.parentNode.querySelector("button[type=button]").hidden = false
    })
})

document.querySelectorAll(".movie_table td button[type=submit]").forEach((e) => {
    e.parentNode.parentNode.parentNode.querySelector("form").addEventListener("submit", async (e) => {
        e.preventDefault()
        e.target.parentNode.querySelectorAll("input").forEach(e => e.disabled = true)
        e.target.parentNode.querySelectorAll("textarea").forEach(e => { e.disabled = true; e.removeAttribute("style") })

        const id = e.target.parentNode.querySelector(".id").textContent
        const image_id = e.target.parentNode.querySelector("input[type=file]").getAttribute("image")
        const inputs = Array.from(e.target.parentNode.querySelectorAll("input"))
        const description = e.target.parentNode.querySelector("textarea")
        const [title, director, genre, rating, date, file] = inputs

        let formData = new FormData()

        formData.append('id', id)
        formData.append('title', title.value)
        formData.append('director', director.value)
        formData.append('genre', genre.value)
        formData.append('rating', rating.value)
        formData.append('date', date.value)
        if (file.files[0]) {
            formData.append('image_id', image_id)
            formData.append('file', file.files[0])
        }
        formData.append('description', description.value)

        const response = await fetch("../assets/php/movie_update.php", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        })

        if (response.ok) {
            Swal.fire({
                title: '¡Usted ha actualizado la pelicula con exito!',
                text: '¡Gracias por usar nuestros servicios!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location = "./dashboard.php"
            })
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Pruebe nuevamente',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }
        e.target.parentNode.querySelectorAll("input").forEach(e => e.disabled = false)
        e.target.parentNode.querySelectorAll("textarea").forEach(e => e.disabled = false)
        e.target.parentNode.querySelectorAll("input[type=file]~label").forEach((e) => { e.querySelector("a").classList.remove("disabled") })
    })
})

document.querySelectorAll(".movie_table td .delete[type=button]").forEach((e) => {
    e.addEventListener("click", async () => {
        const id = e.parentNode.parentNode.querySelector(".id").textContent

        let formData = new FormData()

        formData.append('id', id)

        if (confirm("Esta seguro que quiere remover esta pelicula?")) {
            const response = await fetch("../assets/php/movie_delete.php", {
                method: 'POST',
                body: formData
            })

            if (response.ok) {
                Swal.fire({
                    title: '¡Usted ha removido a la pelicula con exito!',
                    text: '¡Gracias por usar nuestros servicios!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = "./dashboard.php"
                })
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Pruebe nuevamente',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            }
        }
    })
})

document.querySelectorAll(".movie_section .movie_table input[type=file]").forEach((e) => {
    e.addEventListener("change", (e) => {
        const input = e.target
        const a = input.parentNode.querySelector("label a")
        if (input.files[0]) {
            a.textContent = input.files[0].name
        } else {
            a.textContent = a.getAttribute("text")
        }
    })
})