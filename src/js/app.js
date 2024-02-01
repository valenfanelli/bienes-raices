document.addEventListener('DOMContentLoaded', function(){
    eventListeners();
    darkMode();
});
function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
}
function navegacionResponsive() {
    const nav = document.querySelector('.navegacion');
    nav.classList.toggle('mostrar'); //le saca o le pone la clase
}
function darkMode() {
    const dark = window.matchMedia('(prefers-color-scheme: dark)');
    if(dark.matches){
        document.body.classList.add('dark-mode');
    }
    else {
        document.body.classList.remove('dark-mode');
    }
    dark.addEventListener('change', function() {
        if(dark.matches){
            document.body.classList.add('dark-mode');
        }
        else {
            document.body.classList.remove('dark-mode');
        }
    })
    darkbtn = document.querySelector('.dark-mode-boton');
    darkbtn.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    })
}