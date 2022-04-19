const closeBtn = document.querySelector('.closebtn');
const openBtn = document.querySelector('.openbtn');
const sideBar = document.querySelector('.sidebar');
let deleteCourseBtn2 = document.querySelector('.delete-course-btn');
const sidebarHide = document.querySelectorAll('.hide-event');

closeBtn.addEventListener('click', function(){
 
    sideBar.style.width = "0%";
   deleteCourseBtn2.style.display = "none";
    sidebarHide.forEach(item  => {
        item.style.display = "none";
       
    });
});

openBtn.addEventListener('click', function(){
 deleteCourseBtn2.style.display = "block";
    sidebarHide.forEach(item  => {
        item.style.display = "block";
        
    });
    sideBar.style.width = "10%";
});


