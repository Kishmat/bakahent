let header = document.querySelector('header');
let menu = document.getElementById('menu-icon');
let navbar = document.querySelector('.navbar');
menu.onclick =  ()=>{
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
};
window.onscroll = ()=>{
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');
    header.classList.toggle('active', window.scrollY > 5);
};