window.addEventListener("DOMContentLoaded", () => {
    for (let vid of document.querySelectorAll("#vid-gallery video")) {
      // (A) CLICK ON THUMBNAIL TO GO FULLSCREEN
      vid.onclick = () => {
        if (!vid.fullscreenElement) {
          vid.controls = true;
          vid.requestFullscreen();
        }
      };
      
      // (B) EXIT FULLSCREEN MODE
      vid.onfullscreenchange = () => {
        if (document.fullscreenElement == null) {
          vid.controls = false;
          vid.pause();
        }
      };
    }
  });