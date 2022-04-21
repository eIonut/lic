const closeBtn = document.querySelector('.closebtn');
const openBtn = document.querySelector('.openbtn');
const sideBar = document.querySelector('.sidebar');
let deleteCourseBtn2 = document.querySelector('.delete-course-btn');
const sidebarHide = document.querySelectorAll('.hide-event');
// openBtn.style.display = "none";
closeBtn.addEventListener('click', function(){
    openBtn.classList.add('openbtnAdd');
    sideBar.style.display = "none";
    // openBtn.style.display = "block";
   deleteCourseBtn2.style.display = "none";
    sidebarHide.forEach(item  => {
        item.style.display = "none";
       
    });
    this.style.display = "none";
    // const openButton = document.createElement('a');
    // openButton.classList.add('addButton');
    // document.body.append(openButton);
    
});

openBtn.addEventListener('click', function(){
    openBtn.classList.remove('openbtnAdd');
   
 deleteCourseBtn2.style.display = "block";
    sidebarHide.forEach(item  => {
        item.style.display = "block";
        
    });
    sideBar.style.display = "block";
    // this.style.display = "none";
    closeBtn.style.display = "block";
  
});


