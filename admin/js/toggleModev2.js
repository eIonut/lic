const mainContent = document.querySelector("#main-content");
const navbar = document.querySelector("#navbar");
const toggleBtn = document.querySelector("#toggle");
const asd = document.getElementById("navbar");
const asdf = document.querySelectorAll(".course-content");
const blob = document.querySelector(".blob");
const section = document.querySelector("#course-section");
const coursesh1 = document.querySelector('.your-courses');

toggleBtn.addEventListener("click", function () {
  navbar.classList.toggle('dark-mode');
  section.classList.toggle('dark-mode');
  mainContent.classList.toggle('dark-mode');
  for(let i = 0; i < asdf.length; i++){
      asdf[i].classList.toggle('shadow-mode');
  }
  blob.classList.toggle('blob-shadow');
  coursesh1.classList.toggle('dark-mode');
});
