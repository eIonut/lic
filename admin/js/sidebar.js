const closeBtn = document.querySelector('.closebtn');
const openBtn = document.querySelector('.openbtn');
const sideBar = document.querySelector('.sidebar');
const content = document.querySelector('.all-content');
const main_content = document.querySelector('#main-content');
const sidebarHide = document.querySelectorAll('.hide-event');

const courseSection = document.querySelector('#course-section');

//openBtn.style.display = "none";
closeBtn.addEventListener('click', function(){
    openBtn.classList.toggle("openbtnAdd");
    // courseSection.style.width = "100%";
    // courseSection.style.gridTemplateColumns = 'repeat(5, 1fr)';
    sideBar.style.display = "none";
   
    //openBtn.style.display = "block";
  
    main_content.style.gridColumn = "1/4";
    sidebarHide.forEach(item  => {
        item.style.display = "none";
        
    });
    
   
   
    
});

openBtn.addEventListener('click', function(){
    openBtn.classList.toggle("openbtnAdd");
    console.log("apasa");
    sidebarHide.forEach(item  => {
        item.style.display = "block";
     
    });
    main_content.style.gridColumn = "2/4";
    sideBar.style.display = "block";
    // content.style.gridTemplateColumns = "10% 45% 45%";
    // main_content.style.gridTemplateColumns = "10% 45% 45%";

});


