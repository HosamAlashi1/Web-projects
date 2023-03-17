/* The Slider Code >> The Default Categories*/
function toLunchMeal() {
    document.querySelector(".rest").classList.remove("active");
    document.querySelector(".brfast").classList.remove("active");
    document.querySelector(".lunch-btn").classList.add("active");
    document.querySelector(".restaurant").classList.remove("show");
    document.querySelector(".breakfast").classList.remove("show");
    document.querySelector(".lunch").classList.add("show");
}
function toBreakfastMeal() {
    document.querySelector(".rest").classList.remove("active");
    document.querySelector(".lunch-btn").classList.remove("active");
    document.querySelector(".brfast").classList.add("active");
    document.querySelector(".restaurant").classList.remove("show");
    document.querySelector(".lunch").classList.remove("show");
    document.querySelector(".breakfast").classList.add("show");
}
function toRestaurantMeal() {
    document.querySelector(".brfast").classList.remove("active");
    document.querySelector(".lunch-btn").classList.remove("active");
    document.querySelector(".rest").classList.add("active");
    document.querySelector(".lunch").classList.remove("show");
    document.querySelector(".breakfast").classList.remove("show");
    document.querySelector(".restaurant").classList.add("show");
}
/* Scroll To Top */

var scrollToTopBtn = document.querySelector(".scrollToTopBtn");
var rootElement = document.documentElement;

function handleScroll() {
    var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
    if ((rootElement.scrollTop / scrollTotal) > 0.13) {
        scrollToTopBtn.classList.add("showBtn")
    } else {
        scrollToTopBtn.classList.remove("showBtn")
    }
}

function scrollToTop() {
    rootElement.scrollTo({
        top: 0,
        behavior: 'smooth'
    })
}
scrollToTopBtn.addEventListener("click", scrollToTop);
document.addEventListener("scroll", handleScroll);
