const closeBtn = document.querySelector('.closebtn');
const openBtn = document.querySelector('.openbtn');
const sideBar = document.querySelector('.sidebar');
const deleteCourseBtn = document.querySelector('.delete-course-btn');
const sidebarHide = document.querySelectorAll('.hide-event');

closeBtn.addEventListener('click', function(){
 
    sideBar.style.width = "0%";
    deleteCourseBtn.style.display = "none";
    sidebarHide.forEach(item  => {
        item.style.display = "none";
       
    });
});

openBtn.addEventListener('click', function(){
    deleteCourseBtn.style.display = "block";
    sidebarHide.forEach(item  => {
        item.style.display = "block";
        
    });
    sideBar.style.width = "10%";
});


