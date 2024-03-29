const collapseBtn = document.querySelector(".collapse-btn");
const gridContainer = document.querySelector(".container-grid");
const sidebar = document.querySelector(".sidebar");
const deleteBtns = document.querySelectorAll(".delete-btn");
const editBtns = document.querySelectorAll(".edit-btn");
const editModeToggle = document.querySelector(".edit-mode-btn");
const editIcon = document.querySelector(".edit-icon");

collapseBtn.addEventListener("click", function () {
  let collapseDivsPadding = document.getElementsByClassName("p0-collapse");
  for (var i = 0; i < collapseDivsPadding.length; i++) {
    collapseDivsPadding[i].classList.toggle("p0-custom");
  }

  let icons = document.getElementsByClassName("sidebar-icons");
  for (var i = 0; i < icons.length; i++) {
    icons[i].classList.toggle("mx-auto");
    icons[i].classList.toggle("opacity-100");
  }
  gridContainer.classList.toggle("collapsed");
  var els = document.getElementsByClassName("hide-event");
  for (var i = 0; i < els.length; i++) {
    els[i].classList.toggle("d-none");
    els[i].classList.toggle("mx-auto");
  }

  if (gridContainer.classList.contains("collapsed")) {
    editModeToggle.innerHTML = `<i class="fa-solid mx-auto fa-wand-magic "></i>`;
  } else {
    editModeToggle.textContent = "Edit Mode";
  }
});

// var acc = document.getElementsByClassName("accordion");
var panels = document.getElementsByClassName("panel");
let playBtn = document.querySelectorAll(".play-btn");
let courseVideo = document.querySelectorAll(".course-video");
let videosDiv = document.querySelector("#videoDiv");
var panels = document.querySelectorAll(".panel");
// var videoDuration = document.querySelectorAll(".timer");
// var i;

// for (i = 0; i < acc.length; i++) {
//   acc[i].addEventListener("click", function () {
//     this.classList.toggle("active");
//     var panel = this.nextElementSibling;
//     if (panel.style.maxHeight) {
//       panel.classList.remove("p-4");
//       panel.style.maxHeight = null;
//     } else {
//       panel.classList.add("p-4");
//       panel.style.maxHeight = panel.scrollHeight + "px";
//     }
//   });
// }

playBtn.forEach((item, index) => {
  item.addEventListener("click", (event) => {
    videosDiv.innerHTML = ``;
    let source = courseVideo[index].currentSrc;
    videosDiv.innerHTML = `<video
    class="course-video" src=${source} width="100%" height="100%" controls volume="1">';
    </video>`;
  });
});

window.addEventListener("DOMContentLoaded", function () {
  deleteBtns.forEach((item) => {
    item.classList.add("d-none");
  });

  editBtns.forEach((item) => {
    item.classList.add("d-none");
  });
  courseVideo.forEach((item, index) => {
    item.style.display = "none";
    //   item.addEventListener("loadedmetadata", (event) => {
    //     var duration = item.duration;
    //     var minutes = parseInt(duration / 60, 10);
    //     var seconds = duration % 60;
    //     videoDuration[index].textContent = `${minutes}min ${seconds.toFixed(0)}s`;
    //   });
  });
});

courseVideo.forEach((items) => {
  panels.forEach((item) => {
    if (item.contains(items)) {
      videosDiv.innerHTML = `<video
        class="course-video" src=${courseVideo[0].currentSrc} width="100%" height="100%" controls volume="1">';
        </video>`;
    }
  });
});

// const convertVideoDuration = (video) => {
//   var minutes = parseInt(video.duration / 60, 10);
//   var seconds = video.duration % 60;
//   const videoTimer = [];
//   videoTimer.push(minutes, seconds);
//   return videoTimer;
// };

editModeToggle.addEventListener("click", () => {
  if (editModeToggle.style.opacity == "0.75") {
    editModeToggle.style.opacity = "1";
  } else {
    editModeToggle.style.opacity = "0.75";
  }

  deleteBtns.forEach((item) => {
    item.classList.toggle("d-none");
  });

  editBtns.forEach((item) => {
    item.classList.toggle("d-none");
  });
});

deleteBtns.forEach((item) => {
  item.addEventListener("click", function (e) {
    var txt;
    var r = confirm("Are you sure you want to delete?");
    if (r == true) {
      txt = "You pressed OK!";
    } else {
      txt = "You pressed Cancel!";
      e.preventDefault();
    }
    return txt;
  });
});
