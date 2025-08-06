(($) => {
  $(document).ready(() => {
    if (window.innerWidth > 1200) {
      return;
    }

    const wrapSearch = document.querySelector(".wrap-search");

    if (!wrapSearch) {
      return;
    }

    const toggleButton = wrapSearch.querySelector("#mobile-search-button");
    toggleButton.addEventListener("click", () => {
      wrapSearch.classList.toggle("open");
    });

    // close search on click outside
    document.addEventListener("click", (e) => {
      if (!wrapSearch.contains(e.target)) {
        wrapSearch.classList.remove("open");
      }
    });

    // close if esc pressed
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        wrapSearch.classList.remove("open");
      }
    });
  });
})(jQuery);
