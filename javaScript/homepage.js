document.addEventListener("DOMContentLoaded", function () {

    const moreBtn = document.getElementById("moreBtn");
    const dropdownMenu = document.getElementById("dropdownMenu");

    if (moreBtn && dropdownMenu) {

        moreBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle("active");
        });

        document.addEventListener("click", function (e) {
            if (
                !moreBtn.contains(e.target) &&
                !dropdownMenu.contains(e.target)
            ) {
                dropdownMenu.classList.remove("active");
            }
        });
    }
});