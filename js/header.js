function toggleMenu() {
    var menuIcon = document.getElementById("menuIcon");
    var closeIcon = document.getElementById("closeIcon");
    var menuCheckbox = document.getElementById("menu");
    var menuContainer = document.querySelector(".menu");

    menuContainer.classList.toggle("open");
    menuCheckbox.checked = !menuCheckbox.checked;
}