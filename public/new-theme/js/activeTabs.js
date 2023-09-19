function active() {
    document.getElementsByClassName("nav").scrollLeft += 100;
    if (document.documentElement.lang === "ar") {
        let parentElement = document.querySelector(".nav");
        let childElement = document.querySelector(".active");
        parentElement.scrollLeft =
            childElement.offsetLeft - parentElement.offsetLeft - 10;
    } else {
        let parentElement = document.querySelector(".nav");
        let childElement = document.querySelector(".active");
        parentElement.scrollRight =
            childElement.offsetRight - parentElement.offsetRight - 10;
    }
}

active();
window.addEventListener(
    "resize",
    function (event) {
        active();
    },
    true
);
