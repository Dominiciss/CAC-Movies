document.querySelector(".login").addEventListener("submit", function(e) {
    console.log("Formulario enviado");
});


// document.querySelector(".login").addEventListener("submit", (e) => {
//     e.preventDefault()
//     const [email, password] = Array.from(e.target.querySelectorAll("input")).map((input) => input);

//     let valid = true;

//     if (email.value.trim() === "" || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email.value)) {
//         email.parentNode.querySelector(".error").classList.remove("hidden");
//         valid = false;
//     } else {
//         email.parentNode.querySelector(".error").classList.add("hidden");
//     }

//     // Validar el campo de password
//     if (password.value.trim() === "" || !/[a-zA-Z0-9]{4,}/.test(password.value)) {
//         password.parentNode.querySelector(".error").classList.remove("hidden");
//         valid = false;
//     } else {
//         password.parentNode.querySelector(".error").classList.add("hidden");
//     }

//     if (email.value.trim() !== "" && password.value.trim() !== "") {
//         Swal.fire({
//             icon: 'success',
//             title: 'Bienvenido',
//             confirmButtonText: 'Ok'
//         });
//         console.log("Login exitoso");
//     }
// })

