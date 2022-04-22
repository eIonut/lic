var acc = document.querySelectorAll(".accordion");
var panels = document.querySelector(".panel");

let courseVideo = document.querySelectorAll(".course-video");
let courseVideoSource = document.querySelectorAll(".course-video-source");
let playBtn = document.querySelectorAll(".play-btn");
let deleteCourseBtn = document.querySelector('.delete-course-btn');
var panelss = document.querySelectorAll(".panel");
const videoDurationTimer = document.querySelectorAll('.video-duration');
let coursesDiv = document.querySelector('.courses');
let courseBtn = document.querySelector('.courseCloseBtn');
let btnOpenCourseContent = document.querySelector('.close-course-btn');

let videoSrc = '';
var i;
let panel;
let ok = false;

let videoDuration;

courseBtn.addEventListener('click', function(){
  // btnOpenCourseContent.classList.add('courseOpenBtnAdd');
  btnOpenCourseContent.style.display = "block";
  btnOpenCourseContent.style.visibility = 'visible';
  btnOpenCourseContent.classList.toggle("showCoursesAgain");
  
  for(let [i, video] of courseVideo.entries()){
    video.style.visibility = 'visible';
    video.style.width = '100%';  
  }
  
  coursesDiv.style.visibility = "hidden";
    console.log(acc)
  acc.forEach(function(ac){
    ac.style.transition = "all 0s";
  })  
});

btnOpenCourseContent.addEventListener('click', function(){
  btnOpenCourseContent.classList.toggle("showCoursesAgain");
  btnOpenCourseContent.style.visibility = 'hidden';
  for(let [i, video] of courseVideo.entries()){
    video.style.width = '70%';  
  }
  
  coursesDiv.style.visibility = "visible";
    console.log(acc)
  acc.forEach(function(ac){
    ac.style.transition = "all 0.3s";
  })  
});

  
coursesDiv.addEventListener('mouseenter', function(){
  for(let [i, video] of courseVideo.entries()){
    var [m, s] = convertVideoDuration(video);
    videoDurationTimer[i].textContent = `${m}m and ${Math.floor(s.toFixed(0))}s`;
  }
});


function checkPdf(){
  courseVideo.forEach((item, index, buttons) => 
    {
        videoSrc = item.getAttribute('src');
        if(videoSrc.includes('.pdf') || videoSrc.includes('.docx')){
          console.log(videoSrc);
   
     
            playBtn[index].style.display = "none";

         
          item.style.display = "none";
        }
    });
}



window.addEventListener('load', function(){
  btnOpenCourseContent.style.visibility = "hidden";
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
      panel.style.maxHeight = panel.scrollHeight  + "px";
    }
  });
}});

let video_indexes = [];

 playBtn.forEach((item, index, buttons) => {
    item.addEventListener('click', event => {
      deleteCourseBtn.style.display = "none";
      openBtn.classList.add('openbtnAdd');
   
      video_indexes.push(index);
       
       
       if(video_indexes.length == 2){
        courseVideo[video_indexes[video_indexes.length-2]].pause();
        // courseVideo[video_indexes[video_indexes.length-2]].currentTime = 0;
        courseVideo[video_indexes[video_indexes.length-2]].style.display = "none";
       }
       
       if(video_indexes.length == 3){
        video_indexes.shift();
        courseVideo[video_indexes[video_indexes.length-2]].pause();
        // courseVideo[video_indexes[video_indexes.length-2]].currentTime = 0;
       courseVideo[video_indexes[video_indexes.length-2]].style.display = "none";
       }

       sideBar.style.display= "none";
       sidebarHide.forEach(item  => {
        item.style.display = "none";
    
    });
        courseVideo[video_indexes[video_indexes.length-1]].pause();
        courseVideo[video_indexes[video_indexes.length-1]].style.position = 'absolute';
        courseVideo[video_indexes[video_indexes.length-1]].style.left = '0px';
        courseVideo[video_indexes[video_indexes.length-1]].style.top = '0%';
        courseVideo[video_indexes[video_indexes.length-1]].style.width = '70%';
        courseVideo[video_indexes[video_indexes.length-1]].style.height = '70%';
        courseVideo[video_indexes[video_indexes.length-1]].style.display = "block";   

        // console.log(video_indexes[video_indexes.length-1]);
        // const [minutes, seconds] = convertVideoDuration(courseVideo[video_indexes[video_indexes.length-1]]);
        // console.log(`Minutes = ${minutes}`)
        // videoDurationTimer[video_indexes.length-1].textContent = `${minutes}m and ${seconds.toFixed(0)}s`; 

  })
  });

  const convertVideoDuration = (video) =>{
    var minutes = parseInt(video.duration / 60, 10);
    var seconds = video.duration % 60;
    const videoTimer = [];
    videoTimer.push(minutes, seconds);
    return videoTimer;
  }
