const closeBtn = document.querySelector('.closebtn');
const openBtn = document.querySelector('.openbtn');
const sideBar = document.querySelector('.sidebar');

const sidebarHide = document.querySelectorAll('.hide-event');

closeBtn.addEventListener('click', function(){
 
    sideBar.style.width = "0%";

    sidebarHide.forEach(item  => {
        item.style.display = "none";
    
    });
});

openBtn.addEventListener('click', function(){
    sidebarHide.forEach(item  => {
        item.style.display = "block";
    
    });
    sideBar.style.width = "10%";
});


