// Search form in navbar
const openSearchForm = (e) => {
    e.preventDefault();
    searchForm.classList.remove("d-none");
};
const closeSearchForm = () => searchForm.classList.add("d-none");

const searchBtn = document.getElementById("search-btn");
const closeSearchFormBtn = document.getElementById("close-search-form-btn");
const searchForm = document.getElementById("search-form");
searchBtn.addEventListener("click", openSearchForm);
closeSearchFormBtn.addEventListener("click", closeSearchForm);

// Navbar background
if (document.querySelector(".home_slider") != undefined) {
    const homeSlider = document.querySelector(".home_slider");
    const navbarBrand = document.querySelector(".navbar-brand img");

    window.addEventListener("scroll", () => {
        if (window.scrollY >= homeSlider.clientHeight - 40) {
            document
                .querySelector("body")
                .classList.remove("navbar-transparen");
            navbarBrand.src = navbarBrand.src.replace("white", "dark");
        } else {
            document.querySelector("body").classList.add("navbar-transparen");
            navbarBrand.src = navbarBrand.src.replace("dark", "white");
        }
    });
}
