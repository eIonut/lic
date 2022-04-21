const closeBtn = document.querySelector('.closebtn');
const openBtn = document.querySelector('.openbtn');
const sideBar = document.querySelector('.sidebar');
const content = document.querySelector('.all-content');
const main_content = document.querySelector('#main-content');
const sidebarHide = document.querySelectorAll('.hide-event');

openBtn.style.display = "none";
closeBtn.addEventListener('click', function(){
 
    sideBar.style.display = "none";
    openBtn.style.display = "block";
    content.style.gridTemplateColumns = "0% 50% 50%";
    main_content.style.gridTemplateColumns = "0% 50% 50%";
    sidebarHide.forEach(item  => {
        item.style.display = "none";
        
    });
  
   
    
});
 
main_content.addEventListener('click', function(){
    console.log("hi");
});
 

openBtn.addEventListener('click', function(){
    console.log("apasa");
    sidebarHide.forEach(item  => {
        item.style.display = "block";
     
    });
    
    sideBar.style.display = "block";
    content.style.gridTemplateColumns = "10% 45% 45%";
    main_content.style.gridTemplateColumns = "10% 45% 45%";
    this.style.display = "none";
});


