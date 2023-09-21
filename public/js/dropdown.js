const burger = document.querySelector("#burger");
const dropdown = document.querySelector("#dropdown");

burger.addEventListener("click", () => {
    if (dropdown.classList.contains("hidden")) {
        dropdown.classList.remove("hidden");
    } else {
        dropdown.classList.add("hidden");
    }
});