const navItems = document.querySelector('.nav_items');
const openNavBtn = document.querySelector('#open_nav_btn');
const closeNavBtn = document.querySelector('#close_nav_btn');


// open nav dropdown

const openNav = () => {
    navItems.style.display = 'flex';
    openNavBtn.style.display = 'none';
    closeNavBtn.style.display = 'inline-block';

}

// close nav dropdown
const closeNav = () => {
    navItems.style.display = 'none';
    openNavBtn.style.display = 'inline-block';
    closeNavBtn.style.display = 'none';

}

openNavBtn.addEventListener('click', openNav);
closeNavBtn.addEventListener('click', closeNav);

const sidebar = document.querySelector("aside");
const showsidebar = document.querySelector("#show_sidebar");
const hidesidebar = document.querySelector("#hide_sidebar");

const ShowSidebar = () => {
    sidebar.style.left = '0';
    showsidebar.style.display = "none";
    hidesidebar.style.display = "inline-block"
}
const HideSidebar = () => {
    sidebar.style.left = '-100%';
    showsidebar.style.display = "inline-block";
    hidesidebar.style.display = "none"
}

showsidebar.addEventListener("click", ShowSidebar);
hidesidebar.addEventListener("click", HideSidebar);