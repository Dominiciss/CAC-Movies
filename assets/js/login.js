document.querySelector(".login").addEventListener("submit", (e) => {
    e.preventDefault()
    const [email, password] = Array.from(e.target.querySelectorAll("input")).map((input) => input);

    if (email.value == "" || email.value == undefined || email.value == null || email.value == " " || !/([a-zA-Z0-9]+[@][a-zA-Z]+)[.][a-zA-Z0-9]+/.test(email.value)) {
        email.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (password.value == "" || password.value == undefined || password.value == null || password.value == " " || !/[a-z0-9]{4,}/i.test(password.value)) {
        password.parentNode.querySelector(".error").classList.remove("hidden")
    }

    if (email.value.trim() !== "" && password.value.trim() !== "") {
        Swal.fire({
            icon: 'success',
            title: 'Bienvenido',
            confirmButtonText: 'Ok'
        });
    }
})

