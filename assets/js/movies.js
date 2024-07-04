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

const movies = document.querySelectorAll(".movie_container>a.item")

const search = (e = document.querySelector("input[name=search]")) => {
    let input = e
    if (e.target) {
        input = e.target
    }

    movies.forEach((_e) => {
        if (input.value == "") {
            _e.classList.remove("hidden")
            return
        }

        if (_e.querySelector(".title").textContent.toLowerCase().includes(input.value.toLowerCase())) {
            _e.classList.remove("hidden")
        } else {
            _e.classList.add("hidden")
        }
    })

    let check = true
    movies.forEach((_e) => {
        if (!_e.classList.contains("hidden")) {
            check = false
            return
        }
    })

    if (check) {
        input.parentNode.querySelector(".no_results").classList.remove("hidden")
    } else {
        input.parentNode.querySelector(".no_results").classList.add("hidden")
    }
}

document.querySelector("input[name=search]").addEventListener("input", search)
search()