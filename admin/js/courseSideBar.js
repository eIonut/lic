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

    for(let [i, video] of courseVideo.entries()){
        video.style.visibility = 'visible';
        video.style.position = "absolute";
        video.style.left = "0px";
        video.style.top = "0px";
        
        video.style.width = '70%';  
        video.style.position = 'absolute';
       
      }
    
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
  
    for(let [i, video] of courseVideo.entries()){
        video.style.visibility = 'visible';
        video.style.width = '55%';  
        video.style.position = 'absolute';
        video.style.top = '-120px';
        video.style.left = '15%';
      }
      
});


