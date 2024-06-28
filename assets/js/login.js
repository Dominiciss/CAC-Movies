/* jshint esversion: 8 */
setTimeout(() => document.querySelector("body>div").innerHTML = "", 100)

document.querySelector(".login").addEventListener("submit", async (e) => {
    e.preventDefault()
    const [email, password] = Array.from(e.target.querySelectorAll("input")).map((input) => input);

    let isValid = true

    isValid &= validateInput(email, /^[a-zA-Z0-9]+[@][a-zA-Z]+[.][a-zA-Z0-9]+$/)
    isValid &= validateInput(password, /^[a-z0-9]{4,}$/i)

    if (isValid) {
        document.querySelector(".loader-wrapper").hidden = false
        document.querySelector("body").style.overflow = "hidden"

        let formData = new FormData()

        formData.append('email', email.value)
        formData.append('password', password.value)

        const response = await fetch("./../assets/php/login.php", {
            method: 'POST',
            body: formData
        })

        if (response.ok) {
            const data = await response.json()

            document.querySelector(".loader-wrapper").hidden = true
            document.querySelector("body").style.overflow = "auto"

            if (data === undefined || data.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: 'Datos incorrectos.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            } else {
                Swal.fire({
                    icon: 'success',
                    title: `Bienvenido ${data[0][1]}`,
                    confirmButtonText: 'Ok'
                }).then(() => {
                    location.replace("../")
                })
            }
        } else {
            document.querySelector(".loader-wrapper").hidden = true
            document.querySelector("body").style.overflow = "auto"
            Swal.fire({
                title: 'Error',
                text: 'Por favor, espere un momento y vuelva a intentar.',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }
    }
})

function validateInput(input, regex) {
    const isValid = regex.test(input.value.trim())
    if (!isValid) {
        input.parentNode.querySelector(".error").classList.remove("hidden")
    }
    return isValid
}

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

