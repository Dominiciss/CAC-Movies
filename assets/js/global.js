const dropdown = document.querySelector("header nav .dropdown")
const sections = document.querySelectorAll(".fade")

dropdown.addEventListener("click", (e) => {
    const menu = document.querySelector(".right");
    if (menu.style.opacity == "1") {
        menu.classList.remove("open")
        menu.classList.add("close")
        setTimeout(() => {
            if (menu.classList.contains("close")) {
                menu.classList.remove("close")
                menu.style.opacity = "0"
            }
        }, 400)
    } else {
        menu.classList.remove("close")
        menu.classList.add("open")
        menu.style.opacity = "1"
    }
});

document.addEventListener("scroll", () => {
    sections.forEach(section => {
        if (isInView(section)) {
            section.classList.add("fade-in")
        }
    });
});

const isInView = (element) => {
    const rect = element.getBoundingClientRect();

    return (
        rect.bottom > 0 &&
        rect.top < (window.innerHeight || document.documentElement.clientHeight)
    );
};