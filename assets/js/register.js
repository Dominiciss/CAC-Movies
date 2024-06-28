document.querySelector(".input-date").addEventListener("change", validateDate)
document.querySelector(".input-country").addEventListener("change", validateCountry)
Array.from(document.querySelectorAll(".input input[type=password] ~ .eye")).map(e => {e.addEventListener("click", handlePassword)})

document.querySelector(".register").addEventListener("submit", validateForm)

document.querySelectorAll("input").forEach((input) =>
    input.addEventListener("input", hideError)
)

function validateDate(e) {
    const date = e.target
    if (date.value.trim() !== "") {
        date.classList.add("valid")
        date.parentNode.querySelector(".error").classList.add("hidden")
    } else {
        date.classList.remove("valid")
    }
}

function validateCountry(e) {
    const country = e.target
    if (country.value.trim() !== "") {
        country.classList.add("valid")
        country.parentNode.querySelector(".error").classList.add("hidden")
    } else {
        country.classList.remove("valid")
    }
}

async function validateForm(e) {
    e.preventDefault()
    Array.from(e.target.elements).forEach(formElement => formElement.disabled = true);

    const inputs = Array.from(e.target.querySelectorAll(".input-data"))
    const [name, surname, email, password1, password2, date, country, terms] = inputs

    let isValid = true

    isValid &= validateInput(name, /^[a-z ]{2,}$/i)
    isValid &= validateInput(surname, /^[a-z ]{2,}$/i)
    isValid &= validateInput(email, /^[a-zA-Z0-9]+[@][a-zA-Z]+[.][a-zA-Z0-9]+$/)
    isValid &= validateInput(password1, /^[a-z0-9]{4,}$/i)
    isValid &= validateInput(password2, /^[a-z0-9]{4,}$/i)
    isValid &= matchPasswords(password1, password2)
    isValid &= validateInput(date, /.+/)
    isValid &= validateInput(country, /.+/)
    isValid &= validateTerms(terms)

    if (isValid) {
        document.querySelector(".loader-wrapper").hidden = false
        document.querySelector("body").style.overflow = "hidden"

        let formData = new FormData()

        formData.append('name', name.value)
        formData.append('surname', surname.value)
        formData.append('email', email.value)
        formData.append('password', password1.value)
        formData.append('date', date.value)
        formData.append('country', country.value)

        const response = await fetch("./../assets/php/register.php", {
            method: 'POST',
            body: formData
        })

        if (response.ok) {
            document.querySelector(".loader-wrapper").hidden = true
            document.querySelector("body").style.overflow = "auto"
            Swal.fire({
                title: '¡Usted se ha registrado con Éxito!',
                text: '¡Gracias por registrarte con nosotros!',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        } else {
            document.querySelector(".loader-wrapper").hidden = true
            document.querySelector("body").style.overflow = "auto"
            Swal.fire({
                title: 'Error',
                text: 'Pruebe a registrarse nuevamente',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }
    }
    Array.from(e.target.elements).forEach(formElement => formElement.disabled = false);
}

function validateInput(input, regex) {
    const isValid = regex.test(input.value.trim())
    if (!isValid) {
        input.parentNode.querySelector(".error").classList.remove("hidden")
    }
    return isValid
}

function matchPasswords(input1, input2) {
    const isValid = input1.value == input2.value
    if (!isValid) {
        input2.parentNode.querySelector(".error").classList.remove("hidden")
    }
    return isValid
}

function validateTerms(terms) {
    const isValid = terms.checked
    if (!isValid) {
        terms.parentNode.querySelector(".error").classList.remove("hidden")
    }
    return isValid
}

function hideError(e) {
    e.target.parentNode.querySelector(".error").classList.add("hidden")
}

function handlePassword(e) {
    e.target.classList.toggle("close")
    if (e.target.classList.contains("close")) {
        e.target.parentNode.querySelector("input").type = "text"
    } else {
        e.target.parentNode.querySelector("input").type = "password"
    }
}

document.getElementById("logout").addEventListener("click", async (e) => {
    const response = await fetch("./../assets/php/logout.php", {
        method: 'POST',
    })

    if (response.ok) {
        Swal.fire({
            title: '¡Usted se ha deslogueado con exito!',
            text: '¡Adios!',
            icon: 'success',
            confirmButtonText: 'OK'
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