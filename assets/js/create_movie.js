/* jshint esversion: 8 */
setTimeout(() => document.querySelector("body>div").innerHTML = "", 100)

document.querySelectorAll("input").forEach((input) =>
    input.addEventListener("input", (e) => { e.target.parentNode.querySelector(".error").classList.add("hidden") })
)

document.querySelector(".create_movie").addEventListener("submit", async (e) => {
    e.preventDefault()

    const inputs = Array.from(e.target.querySelectorAll(".input-data"))
    const [file, title, director, genre, date, rating, description] = inputs

    let isValid = true

    isValid &= validateFile(file)
    isValid &= validateInput(title, /^[a-z]{2,}$/i)
    isValid &= validateInput(director, /^[a-z]{2,}$/i)
    isValid &= validateInput(genre, /^[a-z]{2,}$/i)
    isValid &= validateInput(rating, /^[a-z0-9.]{1,}$/i)
    isValid &= validateInput(date, /.+/)

    if (isValid) {
        let formData = new FormData()

        formData.append('file', file.files[0])
        formData.append('title', title.value)
        formData.append('director', director.value)
        formData.append('genre', genre.value)
        formData.append('rating', rating.value)
        formData.append('date', date.value)

        const response = await fetch("../assets/php/create_movie.php", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        })

        if (response.ok) {
            Swal.fire({
                title: '¡Usted ha ingresado una pelicula con Éxito!',
                text: '¡Gracias por usar nuestros servicios!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                location.replace("../")
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

document.getElementById("logout")?.addEventListener("click", async (e) => {
    const response = await fetch("../assets/php/logout.php", {
        method: 'POST',
    })

    if (response.ok) {
        Swal.fire({
            title: '¡Usted se ha deslogueado con exito!',
            text: '¡Adios!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            location.replace("../")
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

document.querySelector(".input-date").addEventListener("change", (e) => {
    const date = e.target
    if (date.value.trim() !== "") {
        date.classList.add("valid")
        date.parentNode.querySelector(".error").classList.add("hidden")
    } else {
        date.classList.remove("valid")
    }
})
