(($) => {
  $(document).ready(() => {
    const btnsOpenVideo = document.querySelectorAll(".play-full-video");

    if (btnsOpenVideo) {
      btnsOpenVideo.forEach((btn) => {
        btn.addEventListener("click", () => {
          const video = document.querySelector(".popup-video");
          video.classList.add("is-active");

          // and play the video
          video.querySelector("video").play();
        });
      });
    }

    function handleClosePopup() {
      const videoPopup = document.querySelector(".popup-video");
      const video = document.querySelector(".popup-video video");
      videoPopup.classList.remove("is-active");
      // also pause the video
      video.pause();
    }

    const closeBtn = document.querySelector(".popup-video-close");
    if (closeBtn) {
      closeBtn.addEventListener("click", handleClosePopup); 
    }

    // also close if the esc key is pressed
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        handleClosePopup();
      }
    });
  });
})(jQuery);
