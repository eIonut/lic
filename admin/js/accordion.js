var acc = document.getElementsByClassName("accordion");
var panels = document.querySelector(".panel");
let courseVideo = document.querySelectorAll(".course-video");
let courseVideoSource = document.querySelectorAll(".course-video-source");
let playBtn = document.querySelectorAll(".play-btn");
let collapseBtn = document.querySelectorAll(".collapse-btn");
var panelss = document.querySelectorAll(".panel");
let videoSrc = '';
var i;
let panel;
let ok = false;

function checkPdf(){
  courseVideo.forEach((item, index, buttons) => 
    {
        videoSrc = item.getAttribute('src');
        if(videoSrc.includes('.pdf') || videoSrc.includes('.docx')){
          console.log(videoSrc);
   
     
            playBtn[index].style.display = "none";
              
           
           
              collapseBtn[index].style.display = "none";
                
            
         
          item.style.display = "none";
        }
    });
}
window.addEventListener('load', function(){
  checkPdf();
    
  courseVideo.forEach((item, index, buttons) => 
  {
    item.style.display = 'none';
  });

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}});

let video_indexes = [];

 playBtn.forEach((item, index, buttons) => {
    item.addEventListener('click', event => {

      video_indexes.push(index);
       
       
       if(video_indexes.length == 2){
        courseVideo[video_indexes[video_indexes.length-2]].pause();
        courseVideo[video_indexes[video_indexes.length-2]].currentTime = 0;
        courseVideo[video_indexes[video_indexes.length-2]].style.display = "none";
       }
       
       if(video_indexes.length == 3){
        video_indexes.shift();
        courseVideo[video_indexes[video_indexes.length-2]].pause();
        courseVideo[video_indexes[video_indexes.length-2]].currentTime = 0;
       courseVideo[video_indexes[video_indexes.length-2]].style.display = "none";
       }

        courseVideo[video_indexes[video_indexes.length-1]].play();
        courseVideo[video_indexes[video_indexes.length-1]].style.position = 'absolute';
        courseVideo[video_indexes[video_indexes.length-1]].style.left = '0px';
        courseVideo[video_indexes[video_indexes.length-1]].style.top = '-8.5%';
        courseVideo[video_indexes[video_indexes.length-1]].style.width = '75%';
        courseVideo[video_indexes[video_indexes.length-1]].style.height = '70%';
        courseVideo[video_indexes[video_indexes.length-1]].style.display = "block";   
     
    })
  });


  collapseBtn.forEach((item, index, buttons) => {
    item.addEventListener('click', event => {
      
        courseVideo[index].style.position = 'relative';
        courseVideo[index].style.width = '100%';
        courseVideo[index].style.display = "none";

      
        
    })
  });
