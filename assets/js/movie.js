/* jshint esversion: 8 */
setTimeout((ad = document.querySelector("body>div")) => {
    if (ad) {
        ad.innerHTML = ""
    }
}, 100)

document.getElementById("logout")?.addEventListener("click", async (e) => {
    const response = await fetch("./assets/php/logout.php", {
        method: 'POST',
    })

    if (response.ok) {
        Swal.fire({
            title: '¡Usted se ha deslogueado con exito!',
            text: '¡Adios!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location = "./"
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
