const hideBarItems = document.querySelectorAll('.hide-event');
const sideBar = document.getElementById("mySidebar");
function openNav() {
  document.getElementById("main-content").classList.add("card-transition");
  document.getElementById("course-section").classList.add("card-transition");
  document.getElementById("mySidebar").style.width = "200px";
  // document.getElementById("main").style.marginLeft = "200px";
  document.getElementById("main-content").style.marginLeft = "200px";

  
 
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("course-section").classList.add("card-transition");
  document.getElementById("main-content").classList.add("card-transition");
  document.getElementById("mySidebar").style.width = "0px";
  // document.getElementById("main").style.marginLeft = "0px";
  document.getElementById("main-content").style.marginLeft = "0px";


}

const closebtn = document.querySelector(".closebtn");
const openbtn = document.querySelector(".openbtn");

closebtn.addEventListener('click', function(){
  hideBarItems.forEach(item => {
    item.style.display = 'none';
  })
  
  if(sideBar.style.width == '0px'){
    openbtn.classList.remove('disable');
  }
  openbtn.style.left = "0px";
  
    
  
})

openbtn.addEventListener('click', function(){
  hideBarItems.forEach(item => {
    item.style.display = 'block';
  })
  if(sideBar.style.width == '200px'){
    openbtn.classList.add('disable');
  }
  openbtn.style.left = "200px";
  
 
  
 
 
})
