($ => {
   $(document).ready(() => {

      // Setup re-useable variables
      const currUrl = window.location.pathname;
      const isListingsArchivePage = currUrl.includes('/listings/'); // Are we on the /listings/ page?
      const isSingleListingPage = currUrl.includes('/listing/'); // Are we on a single /listing/listing-slug/ page?
      const hasBackToListingsBtn = $('.back-to-listings-btn').length > 0;
      const backToListingsBtnElement = $('.back-to-listings-btn');

      // If on a SINGLE listings page & a back to listings btn exists
      if (isSingleListingPage && hasBackToListingsBtn) {

         // Check localStorage for to see if user arrived from Listings Archive page
         let cameFromListingsArchive = localStorage.getItem('cameFromListingsArchive');

         // Remove the 'cameFromListingsArchive' localStorage item, as we don't need it anymore
         localStorage.removeItem('cameFromListingsArchive');

         backToListingsBtnElement.click(function (e) {

            // Set LocalStorage to indicate that we're going back to the Listings Archive FROM a single Listing
            // Used to ensure we don't run the Listing Grid Item highlight feature unnecessarily....
            localStorage.setItem('cameFromSingleListing', 'true');

            // Is user came from the Listings Archive page, and wants to go back using the 'back to listings'
            // link, prevent the default action to retain the filter settings
            // If we didn't come from that page, then just go back to where we arrived from  (team, slider, etc...)
            if (cameFromListingsArchive != null && cameFromListingsArchive == 'true') {

               // Prevent the default a href actions
               e.preventDefault();
               e.stopPropagation();

               // Get current Listing's URL slug
               let prevListingSlug = currUrl.split('/listing/')[1].replace(/\//g, '');

               /**
                * Set localStorage to slug, for use if the users goes back to listings
                * Note: if the user goes elsewhere, and then comes back to a different
                * listing via the listings page, this will be overwritten which is fine!
                */
               localStorage.setItem('previouslyViewedListing', prevListingSlug);

               // Redirect user exactly back to where they came from (incl. filters, last viewed listing in grid, etc)
               window.history.go(-1);
            }

         });

         $(window).unload(function(){
            // Remove the 'cameFromListingsArchive' localStorage item, as we don't need it anymore
            localStorage.removeItem('cameFromListingsArchive');
         });

      }


      // If on listings ARCHIVE page
      if (isListingsArchivePage) {

         // Check localStorage for previously viewed listing
         let prevListingSlug = localStorage.getItem('previouslyViewedListing');
         // Check localStorage to see where we've arrived from
         let cameFromSingleListing = localStorage.getItem('cameFromSingleListing');

         // Only if there is a previous listing AND we arrived from the Single Listing page do we want to continue
         if (prevListingSlug != null && cameFromSingleListing == 'true') {
            // Remove the localStorage item for previously viewed listing, as we don't need it anymore
            localStorage.removeItem('previouslyViewedListing');
            // Remove the localStorage item for where we came from, as we don't need it anymore
            localStorage.removeItem('cameFromSingleListing');

            // Setup the selector used to check when element matching the selector has been loaded
            // Note: this is necessary because the listings grid is loaded via ReactJS, therefore not available on document.ready()
            let listingSelector = 'a[href*="' + prevListingSlug + '"]';
            let loadMoreBtnSelector = 'button.torque-filtered-loop-load-more';
            let prependOverlayToSelector = '.torque-filtered-loop';
            let attemptsBeforeCallingLoadMore = 100;
            let maxTotalAttempts = 4000; // Set high as there are SO. MANY. LISTINGS.
            let searchInterval = 10;
            // Wait until the element is loaded
            waitForEl(listingSelector, scrollToElement, loadMoreBtnSelector, simulateMouseClick, prependOverlayToSelector, attemptsBeforeCallingLoadMore, maxTotalAttempts, searchInterval);
         }

         // Set the locaStorage to let the listing page know we arrived from the Listing Archive,
         // on click of any listing page link matching the selector
         $(document).on('click', '.single-listing-link', function (e) {
            localStorage.setItem('cameFromListingsArchive', 'true');
         });

         $(window).unload(function(){
            // Remove the localStorage item for previously viewed listing, as we don't need it anymore
            localStorage.removeItem('previouslyViewedListing');
            // Remove the localStorage item for where we came from, as we don't need it anymore
            localStorage.removeItem('cameFromSingleListing');
         });

      }

   });

   /**
    * Scrolls to the Listing grid item on page
    * @param {*} elementToScrollTo The jQuery object we'd like to scroll to and highlight
    */
   function scrollToElement(elementToScrollTo) {
      // Element has been found, so scroll it into view!
      $('html, body').animate({
         scrollTop: elementToScrollTo.offset().top - $(window).height() / 3
      }, 10);
      elementScrolledIntoViewport(elementToScrollTo, pulseElement);
   }

   /**
    * Apply an class name to an element, which is associated with a preconfigured CSS pulse animation
    * @param {*} elementToPulse The jQuery object to be 'pulsed'
    */
   function pulseElement(elementToPulse) {
      // Add pulse animation to parent listing grid item element
      elementToPulse
         .first()
         .closest('.loop-post')
         .addClass('pulse');
      // Remove pulse animation from listing grid item after X milliseconds
      setTimeout(function () {
         elementToPulse
            .first()
            .closest('.loop-post')
            .removeClass('pulse');
      }, 1000);
   }


   /**
    * Used to simulate a mouse click event on a element rendered by ReactJS 
    * NOTE: takes native JS DOM element, but if jQuery detected it converts it
    * @param {*} element The element, rendered by ReactJS, we'd like to simulate a click event on
    */
   const reactMouseClickEvents = ['mousedown', 'click', 'mouseup'];
   function simulateMouseClick(element) {
      if (element instanceof jQuery) {
         // Convert to naitive JS DOM element
         element = element[0];
      }
      reactMouseClickEvents.forEach(mouseEventType =>
         element.dispatchEvent(
            new MouseEvent(mouseEventType, {
               view: window,
               bubbles: true,
               cancelable: true,
               buttons: 1
            })
         )
      );
   }

   /**
    * Used to wait for an element to be loaded
    * NOTE: in this case an element rendered by ReactJS
    * @param {*} selector1 The first element to search for in the loop
    * @param {*} callback1 The function to call if selector1 is found
    * @param {*} selector2 The second element to search for in the loop, after maxAttemptsPreCallback2 is reached
    * @param {*} callback2 The function to call if selector2 is found
    * @param {*} prependOverlayToSelector Selector for element you want to prepend the loading overlay to, whilst search takes place
    * @param {*} maxAttemptsPreCallback2 Maximum attempts to find selector1, before we start searching for selector2
    * @param {*} maxTotalNumAttempts The absolute maximum number of attempts to find selector1
    * @param {*} elementSearchInterval Milliseconds to wait between each search for the elements 
    */
   function waitForEl(selector1, callback1, selector2, callback2, prependOverlayToSelector = '', maxAttemptsPreCallback2 = 20, maxTotalNumAttempts = 1000, elementSearchInterval = 10) {
      // Set initial vars
      let attemptCountPreCallback2 = 1;
      let totalAttemptsCounter = 1;

      // Setup the loading overlay, and prepended to the given element based on the overlay selector, if selector is provided
      if (prependOverlayToSelector != '') {
         $(prependOverlayToSelector)
            .css('position', 'relative')
            .prepend('<div class="back-to-listing-overlay"><img class="back-to-listing-loader" src="/wp-content/themes/interra-child/statics/images/loading.gif" width="40px" height="auto" /></div>');
         $('.back-to-listing-overlay').css({
            'cursor': 'progress',
            'position': 'absolute',
            'top': '0',
            'left': '0',
            'height': '100%',
            'width': '100%',
            'background': '#ffffff8c',
            'z-index': '9999'
         });
         $('.back-to-listing-loader').css({
            'position': 'fixed',
            'top': '60%',
            'left': '0',
            'right': '0',
            'margin': '0 auto'
         });
      }

      let poller1 = setInterval(function () {

         // Setup jQuery objects for the two selectors, each interval
         element1 = $(selector1);
         element2 = $(selector2);

         /**
          * IF: We haven't found element1, and we haven't reached the max number of total attempts, search again
          * ELSE IF: We haven't found element1, BUT we've reached the max number of total attempts, abort mission
          * ELSE: We must have found element1, so ping callback1 and exit interval
          */
         if (element1.length < 1 && totalAttemptsCounter <= maxTotalNumAttempts) {

            /**
             * IF: Our total attempts before pinging callback2 is LESS than our threshold, increment the counters and continue to search for element1
             * ELSE IF: Our total attempts before pinging callback2 is GREATER than our threshold, attempt to find element2, and if found ping callback2
             * ELSE: Simply increment the total attempts counter
             */
            if (attemptCountPreCallback2 <= maxAttemptsPreCallback2) {
               // Keep trying to find element1, and increment attemptCountPreCallback2
               attemptCountPreCallback2++;
            } else if (attemptCountPreCallback2 > maxAttemptsPreCallback2) {
               // We've exhausted all attempts, try callback2 now (as long as it exists)!
               if (element2.length > 0) {
                  // Reset the attemptCountPreCallback2 counter
                  attemptCountPreCallback2 = 1;
                  // Attempt to do something via callback2 function
                  callback2(element2);
               } else {
                  // We haven't found element1 yet, and now we cannot find element2, reset the counter and try again!
                  // Reset the attemptCountPreCallback2 counter
                  attemptCountPreCallback2 = 1;
               }
            }

            // Increament the totalAttemptsCounter counter
            totalAttemptsCounter++;

            // Try again to find element1
            return;

         } else if (element1.length < 1 && totalAttemptsCounter > maxTotalNumAttempts) {
            // We have reached the maximum total number of attempts to find element1, but didn't find it unfortunately. Pulling the plug now.
            // Remove loading overlay
            $('.back-to-listing-overlay').remove();
            // Clear the interval
            clearInterval(poller1);
         } else {
            // We found element1!
            // Remove loading overlay
            $('.back-to-listing-overlay').remove();
            // Clear the interval
            clearInterval(poller1);
            // Call function callback1!
            callback1(element1);
         }

      }, elementSearchInterval);
   }

   /**
    * Checks, for a maximum number of attempts at a given interval, 
    * whether an element has been scrolled into the viewport.
    * @param {*} searchElement The jQuery object we're searching for
    * @param {*} callback The callback, to call if we find the element
    * @param {*} maxAttempts The maximum number of attempts (prevents endless loop)
    * @param {*} elementSearchInterval The interval between searching for the element
    */
   function elementScrolledIntoViewport(searchElement, callback, maxAttempts = 1000, elementSearchInterval = 10) {
      let currAttempt = 1;
      let poller1 = setInterval(function () {

         let docViewTop = $(window).scrollTop();
         let docViewBottom = docViewTop + $(window).height();
         let elementTop = searchElement.offset().top;
         let elemntInView = ((elementTop <= docViewBottom) && (elementTop >= docViewTop));

         /**
          * IF: Element not in view, and maximum attemtps not exceeded, increment counter and continue
          * ELSE IF: Element not in view, BUT maximum attemtps exceeded, abort mission
          * ELSE IF: Element is in view! Ping the callback and kill the setInterval
          * ELSE: Just in case, kill the setInterval
          */
         if (!elemntInView && currAttempt <= maxAttempts) {
            currAttempt++;
            return;
         } else if (!elemntInView && currAttempt > maxAttempts) {
            // Clear the interval
            clearInterval(poller1);
         } else if (elemntInView) {
            // Found the element!
            callback(searchElement);
            // Clear the interval
            clearInterval(poller1);
         } else {
            // Clear the interval
            clearInterval(poller1);
         }

      }, elementSearchInterval);
   }

})(jQuery);