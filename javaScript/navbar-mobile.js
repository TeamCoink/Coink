
const menuToggle = document.querySelector(".menu-toggle");
const mobileSidebar = document.querySelector(".mobile-sidebar");
const mobileOverlay = document.querySelector(".mobile-overlay");

if(menuToggle && mobileSidebar && mobileOverlay){

    
    menuToggle.addEventListener("click", () => {

        menuToggle.classList.toggle("active");

        mobileSidebar.classList.toggle("active");

        mobileOverlay.classList.toggle("active");

        document.body.classList.toggle("menu-open");

    });

    
    mobileOverlay.addEventListener("click", () => {

        cerrarMenu();

    });

    document.querySelectorAll(".mobile-sidebar a").forEach(link => {

        link.addEventListener("click", () => {

            cerrarMenu();

        });

    });

    
    function cerrarMenu(){

        menuToggle.classList.remove("active");

        mobileSidebar.classList.remove("active");

        mobileOverlay.classList.remove("active");

        document.body.classList.remove("menu-open");

    }

}






 