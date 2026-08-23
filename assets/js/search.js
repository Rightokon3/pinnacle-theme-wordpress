document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector("#search-page-input");

    if (!input) {
        return;
    }

    /*
     * Focus the search field when the search-results page loads.
     */
    if (window.innerWidth >= 768) {
        input.focus();
    }

    /*
     * Escape clears the search field.
     */
    input.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            input.value = "";
            input.focus();
        }
    });
});