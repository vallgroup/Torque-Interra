(($) => {
  $(document).ready(() => {
    const btnsOpenVideo = document.querySelectorAll(".play-full-video");
    let player;

    // we have a bug that plays the popup video when the page loads
    // so we are going to force a pause on the video if the overlay is not visible
    const video = document.querySelector(".popup-video video");
    const isVideoOverlayVisible = document.querySelector(
      ".popup-video.is-active"
    );
    if (!isVideoOverlayVisible && video) {
      video.pause();
    }

    if (btnsOpenVideo) {
      btnsOpenVideo.forEach((btn) => {
        btn.addEventListener("click", () => {
          const video = document.querySelector(".popup-video");
          video.classList.add("is-active");

          // and play the video
          const isVideo = video.querySelector("video");
          if (isVideo) {
            isVideo.play();
          } else {
            // check if we are playing an iframe vimeo or youtube
            const iframe = video.querySelector("iframe");
            const isVimeo = iframe?.classList?.contains("is_vimeo");
            if (iframe && isVimeo) {
              const playerVimeo = new Vimeo.Player(iframe);
              playerVimeo.play();
            } else {
              if (player) {
                player.play();
                return;
              }
              // is youtube video
              const videoWrapper = document.querySelector(
                "#youtube-video-wrapper"
              );
              const videoId = videoWrapper.getAttribute("data-video-id");
              player = new YT.Player("youtube-video-wrapper", {
                videoId: videoId,
                events: {
                  onReady: onPlayerReady,
                },
              });

              function onPlayerReady(event) {
                //event.target.playVideo();
                player.playVideo();
              }
            }
          }
        });
      });
    }

    function handleClosePopup() {
      const videoPopup = document.querySelector(".popup-video");
      const video = document.querySelector(".popup-video video");
      videoPopup.classList.remove("is-active");
      // also pause the video
      if (video) {
        video.pause();
      } else {
        // check if we are playing an iframe vimeo or youtube
        const iframe = videoPopup.querySelector("iframe");
        const isVimeo = iframe.classList.contains("is_vimeo");
        if (iframe && isVimeo) {
          const playerVimeo = new Vimeo.Player(iframe);
          playerVimeo.pause();
        } else {
          // is youtube video
          player.pauseVideo();
        }
      }
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
