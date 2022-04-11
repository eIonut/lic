var acc = document.getElementsByClassName("accordion");
var panels = document.querySelector(".panel");
var i;
let panel;
window.addEventListener('load', function(){
 
  var panel = acc[0].nextElementSibling;
  panels.style.maxHeight = panel.scrollHeight + "px";
  acc[0].classList.toggle("active");
    
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
}