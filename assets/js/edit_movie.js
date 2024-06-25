// document.addEventListener("DOMContentLoaded", function() {

//     // Validar input genérico
//     function validateInput(input, regex) {
//         const isValid = regex.test(input.value);
//         if (!isValid) {
//             input.parentNode.querySelector(".error").classList.remove("hidden");
//         }
//         return isValid;
//     }

//     // Manejar el submit del formulario de edición
//     const formEdit = document.querySelector(".edit_movie");
//     if (formEdit) {
//         formEdit.addEventListener("submit", (e) => {
//             e.preventDefault();

//             const inputs = Array.from(e.target.querySelectorAll(".input-data"));
//             const image = inputs.find(input => input.name === "image");
//             const title = inputs.find(input => input.name === "title");
//             const director = inputs.find(input => input.name === "director");
//             const genre = inputs.find(input => input.name === "genre");
//             const date = inputs.find(input => input.name === "date");
//             const rating = inputs.find(input => input.name === "rating");
//             const description = inputs.find(input => input.name === "description");

//             let isValid = true;

//             if (image) {
//                 isValid = validateInput(image, /\d+/) && isValid; // Validar que el ID de la imagen sea un número
//             }
//             isValid = validateInput(title, /^[a-z]{2,}$/i) && isValid;
//             isValid = validateInput(director, /^[a-z]{2,}$/i) && isValid;
//             isValid = validateInput(genre, /^[a-z]{2,}$/i) && isValid;
//             isValid = validateInput(rating, /^[a-z0-9.]{1,}$/i) && isValid;
//             isValid = validateInput(date, /.+/) && isValid;

//             if (isValid) {
//                 e.target.submit();
//             }
//         });
//     }
// });
