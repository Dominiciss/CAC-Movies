document.addEventListener("DOMContentLoaded", () => {
    const dropdown = document.querySelector("header nav .dropdown");

    dropdown.addEventListener("click", toggleMenu);

    document.querySelector(".input-date").addEventListener("change", validateDate);
    document.querySelector(".input-country").addEventListener("change", validateCountry);

    document.querySelector(".register").addEventListener("submit", validateForm);

    document.querySelectorAll("input").forEach((input) =>
        input.addEventListener("input", hideError)
    );
});

function validateDate(e) {
    const date = e.target;
    if (date.value.trim() !== "") {
        date.classList.add("valid");
        date.parentNode.querySelector(".error").classList.add("hidden");
    } else {
        date.classList.remove("valid");
    }
}

function validateCountry(e) {
    const country = e.target;
    if (country.value.trim() !== "") {
        country.classList.add("valid");
        country.parentNode.querySelector(".error").classList.add("hidden");
    } else {
        country.classList.remove("valid");
    }
}

function validateForm(e) {
    e.preventDefault();

    const inputs = Array.from(e.target.querySelectorAll(".input-data"));
    const [name, surname, email, password1, password2, date, country, terms] = inputs;

    let isValid = true;

    isValid &= validateInput(name, /^[a-z]{2,}$/i);
    isValid &= validateInput(surname, /^[a-z]{2,}$/i);
    isValid &= validateInput(email, /^[a-zA-Z0-9]+[@][a-zA-Z]+[.][a-zA-Z0-9]+$/);
    isValid &= validateInput(password1, /^[a-z0-9]{4,}$/i);
    isValid &= validateInput(password2, /^[a-z0-9]{4,}$/i);
    isValid &= validateInput(date, /.+/);
    isValid &= validateInput(country, /.+/);
    isValid &= validateTerms(terms);

    if (isValid) {
        Swal.fire({
            title: '¡Usted se ha registrado con Éxito!',
            text: '¡Gracias por registrarte con nosotros!',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
}

function validateInput(input, regex) {
    const isValid = regex.test(input.value.trim());
    if (!isValid) {
        input.parentNode.querySelector(".error").classList.remove("hidden");
    }
    return isValid;
}

function validateTerms(terms) {
    const isValid = terms.checked;
    if (!isValid) {
        terms.parentNode.querySelector(".error").classList.remove("hidden");
    }
    return isValid;
}

function hideError(e) {
    e.target.parentNode.querySelector(".error").classList.add("hidden");
}
