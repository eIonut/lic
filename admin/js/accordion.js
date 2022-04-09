var acc = document.getElementsByClassName("accordion");
var i;

// window.addEventListener('load', (event) => {
//     acc[1].classList.add('active');
//     var panel = acc[0].nextElementSibling;
//     panel.style.display = "block";
//   });

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}