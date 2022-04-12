const closeBtn = document.querySelector('.closebtn');
const openBtn = document.querySelector('.openbtn');
const sideBar = document.querySelector('.sidebar');
const content = document.querySelector('.all-content');
const main_content = document.querySelector('#main-content');
const sidebarHide = document.querySelectorAll('.hide-event');

closeBtn.addEventListener('click', function(){
 
    sideBar.style.width = "0%";
    
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
    sidebarHide.forEach(item  => {
        item.style.display = "block";
     
    });

    sideBar.style.width = "10%";
    content.style.gridTemplateColumns = "10% 45% 45%";
    main_content.style.gridTemplateColumns = "10% 45% 45%";
    
    

  
});


