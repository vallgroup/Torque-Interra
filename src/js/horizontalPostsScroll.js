(($) => {
  $(document).ready(() => {
    const postsWrapper = document.querySelector(".posts-wrapper");

    if (!postsWrapper) {
      return;
    }

    function listenForScroll() {
      // Add the event listener to the container
      postsWrapper.addEventListener("wheel", (event) => {
        // Check the window size every time the event fires
        if (window.innerWidth < 1000) {
          // If the condition is not met, simply return and do nothing
          return;
        }

        const currentScrollLeft = postsWrapper.scrollLeft;
        const maxScrollLeft =
          postsWrapper.scrollWidth - postsWrapper.clientWidth;
        const isScrollingRight = event.deltaY > 0;
        const isScrollingLeft = event.deltaY < 0;
        const tolerance = 10;

        // Check if we are at the end of the scrollable area
        const isAtRightEnd = currentScrollLeft >= maxScrollLeft - tolerance;
        const isAtLeftEnd = currentScrollLeft <= 0;

        // Condition to handle vertical scroll:
        // If scrolling right and we are at the right end, or
        // If scrolling left and we are at the left end.
        if (
          (isScrollingRight && isAtRightEnd) ||
          (isScrollingLeft && isAtLeftEnd)
        ) {
          // Stop the scroll event
          event.stopPropagation();
          return;
        }

        event.preventDefault();

        postsWrapper.scrollBy({
          left: event.deltaY,
          behavior: "smooth",
        });
      });
    }

    listenForScroll();
    // also listen for window resize
    window.addEventListener("resize", listenForScroll);
  });
})(jQuery);

/**
 document.addEventListener('DOMContentLoaded', () => {
  const postsWrapper = document.querySelector('.posts-wrapper');

  if (postsWrapper) {
    postsWrapper.addEventListener('wheel', (event) => {
      // Get the current horizontal scroll position
      const currentScrollLeft = postsWrapper.scrollLeft;

      // Get the maximum horizontal scrollable distance
      const maxScrollLeft = postsWrapper.scrollWidth - postsWrapper.clientWidth;

      // Determine the direction of the scroll
      const isScrollingRight = event.deltaY > 0;
      const isScrollingLeft = event.deltaY < 0;

      // Check if we are at the end of the scrollable area
      const isAtRightEnd = (currentScrollLeft >= maxScrollLeft);
      const isAtLeftEnd = (currentScrollLeft <= 0);

      // Condition to handle vertical scroll:
      // If scrolling right and we are at the right end, or
      // If scrolling left and we are at the left end.
      if ((isScrollingRight && isAtRightEnd) || (isScrollingLeft && isAtLeftEnd)) {
        // Do nothing. Let the default vertical scroll take over.
        return;
      }
      
      // If the conditions above are not met,
      // it means there's still room to scroll horizontally.
      
      // Prevent the default vertical scroll behavior
      event.preventDefault();
      
      // Scroll the container horizontally
      postsWrapper.scrollBy({
        left: event.deltaY,
        behavior: 'smooth'
      });
    });
  }
});
 */
