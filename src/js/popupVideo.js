(($) => {
  $(document).ready(() => {
    const btnsOpenVideo = document.querySelectorAll(".play-full-video");
    console.log(btnsOpenVideo);

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

    const closeBtn = document.querySelector(".popup-video-close");
    if (closeBtn) {
      closeBtn.addEventListener("click", () => {
        const videoPopup = document.querySelector(".popup-video");
        const video = document.querySelector(".popup-video video");
        videoPopup.classList.remove("is-active");
        // also pause the video
        video.pause();
      });
    }

    // also close if the esc key is pressed
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        const videoPopup = document.querySelector(".popup-video");
        const video = document.querySelector(".popup-video video");
        videoPopup.classList.remove("is-active");
        // also pause the video
        video.pause();
      }
    });
  });
})(jQuery);
