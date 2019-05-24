($ => {
   $(document).ready(() => {

      // Setup re-useable variables
      var curr_url = window.location.pathname;
      var is_mobile = $(document).width() <= 425;
      var is_listings_archive_pg = curr_url.includes("/listings/"); // Are we on the /listings/ page?
      var is_single_listing_pg = curr_url.includes("/listing/"); // Are we on a single /listing/listing-slug/ page?
      var has_back_to_listings_btn = $('.back-to-listings-btn').length > 0;
      var back_to_listings_btn_el = $('.back-to-listings-btn');
      /* var has_custom_filters = $('.custom-filters').length > 0; */

      
      // If on a SINGLE listings page & a back to listings btn exists
      if ( is_single_listing_pg && has_back_to_listings_btn ) {

         // Check localStorage for to see if user arrived from Listings Archive page
         var came_from_listings_archive = localStorage.getItem("cameFromListingsArchive");
         console.log('came_from_listings_archive: ' + came_from_listings_archive);

         back_to_listings_btn_el.click(function(e){
            
            // Is user came from the Listings Archive page, and wants to go back using the 'back to listings'
            // link, prevent the default action to retain the filter settings
            // If we didn't come from that page, then just go back to where we arrived from  (team, slider, etc...)
            if ( came_from_listings_archive && came_from_listings_archive == "true" ) {

               // Remove the localStorage item, as we don't need it anymore
               localStorage.removeItem("cameFromListingsArchive");
            
               // Get current Listing's URL slug
               var prev_listing_slug = curr_url.split('/listing/')[1].replace(/\//g,'');
               
               /**
                * Set localStorage to slug, for use if the users goes back to listings
                * Note: if the user goes elsewhere, and then comes back to a different
                * listing via the listings page, this will be overwritten which is fine!
                */
               localStorage.setItem("previouslyViewedListing", prev_listing_slug);
            }

            // Prevent the default a href actions
            e.preventDefault();
            e.stopPropagation();

            // Redirect user exactly back to where they came from (incl. filters, etc)
            window.history.go(-1);
         });
      }

      
      // If on listings ARCHIVE page, filters exist & is mobile width...
      if ( is_listings_archive_pg ) {

         // Check localStorage for previously viewed listing
         var prev_listing_slug = localStorage.getItem("previouslyViewedListing");
         
         if ( prev_listing_slug ) {
            // Remove the localStorage item for previously viewed listing, as we don't need it anymore
            localStorage.removeItem("previouslyViewedListing");

            console.log('prev_listing_slug: ' + prev_listing_slug);
            // Setup the selector used to check when element matching the selector has been loaded
            // Note: this is necessary because the listings grid is loaded via ReactJS, therefore not available on document.ready()
            var listing_selector = 'a[href*="' + prev_listing_slug + '"]';
            var load_more_btn_selector = 'button.torque-filtered-loop-load-more';
            var overlay_selector = '.torque-filtered-loop';
            // Wait until the element is loaded
            waitForEl(listing_selector, scrollToListingItem, load_more_btn_selector, simulateMouseClick, overlay_selector, 5 );
         }

         // Set the locaStorage to let the listing page know we arrived from the Listing Archive,
         // on click of any listing page link matching the selector
         $(document).on('click', '.single-listing-link', function(e) {
            localStorage.setItem("cameFromListingsArchive", "true");
         });

         /* if ( has_custom_filters && is_mobile ) {
            $('.torque-custom-filter-dropdown').click(function(){
               console.log('drop down clicked!');
               if ( $('.torque-custom-filter-dropdown .dropdown-wrapper').hasScrollBar() ){
                  console.log('this content is scrollable...');
               } else {
                  console.log('no scroll bar in sight...');
               }
            });
         } */

      }

   });

   /**
    * Scrolls to the Listing grid item on page
    * @param {*} $jObject_1 
    */
   function scrollToListingItem( $jObject_1 ) {
      // Element has been found, so scroll it into view!
      $('html, body').animate({
         scrollTop: $jObject_1.offset().top - $(window).height()/3
      }, 1, function() {
         // Once we've scrolled to the element, execute the following:
         // Add pulse animation to parent listing grid item element
         $jObject_1
            .first()
            .closest('.loop-post')
            .addClass('pulse');
         // Remove pulse animation from listing grid item after X milliseconds
         setTimeout(function(){
            $jObject_1
               .first()
               .closest('.loop-post')
               .removeClass('pulse');
         },2000);
      });
   }

   /**
    * Used to simulate a mouse click event on a element rendered by ReactJS 
    * NOTE: takes native JS DOM element, but if jQuery detected it converts it
    */
   const reactMouseClickEvents = ['mousedown', 'click', 'mouseup'];
   function simulateMouseClick(element){
      if ( element instanceof jQuery ) {
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
    * @param {*} selector_1 
    * @param {*} callback_1 
    * @param {*} selector_2 
    * @param {*} callback_2 
    * @param {*} overlay_selector 
    * @param {*} max_attempts_pre_cb_2 
    * @param {*} max_total_num_attempts 
    */
   function waitForEl(selector_1, callback_1, selector_2, callback_2, overlay_selector = "", max_attempts_pre_cb_2 = false, max_total_num_attempts = false){
      // Set initial vars
      var attempt_num_pre_cb_2;
      var total_num_attempts;

      // Setup counter to count how many times we've tried to find selector_1, before attempting callback_2
      if ( max_attempts_pre_cb_2 != false && max_attempts_pre_cb_2 > 0 ) {
         // Initalise counter to attempt 1
         attempt_num_pre_cb_2 = 1;
      }

      if ( !max_total_num_attempts ) {
         // Initalise counter to attempt 1
         total_num_attempts = 1;
         // Set an explicit limit, so we don't open a loop hole memory leak...
         max_total_num_attempts = 1000;
      } else {
         // max_total_num_attempts has been set, so just initialise counter to 1
         total_num_attempts = 1;
      }

      // Setup the loading overlay
      if ( overlay_selector != "" ) {
         $(overlay_selector)
            .css('position', 'relative')
            .prepend('<div class="back-to-listing-overlay"></div>');
         $('.back-to-listing-overlay').css({
            'position': 'absolute',
            'top': '0',
            'left': '0',
            'height': '100%',
            'width': '100%',
            'background': '#ffffff8c',
            'z-index': '9999'
         })
      }

      var poller1 = setInterval(function(){

         // Setup jQuery objects for the two selectors, each interval
         $jObject_1 = $(selector_1);
         $jObject_2 = $(selector_2);

         if ( $jObject_1.length < 1 && total_num_attempts <= max_total_num_attempts ) {
            
            /**
             * IF: max_attempts_pre_cb_2 has been set, and we still have attempts remaining to find selector_1
             *    -> Increment attempt_num_pre_cb_2 counter and try to find selector_1 again
             * ELSE IF: max_attempts_pre_cb_2 has been set, and we've exhausted current attempts to find selector_1
             *    -> Reset the attempt_num_pre_cb_2 counter (so we can look again after another max_attempts_pre_cb_2)
             *    -> Call function callback_2, which presumably does something such as load more items into page
             * NONE OF THE ABOVE: Conta
             */
            if ( max_attempts_pre_cb_2 != false && attempt_num_pre_cb_2 <= max_attempts_pre_cb_2 ) {
               // Keep trying to find element_1, and increment attempt_num var
               console.log('attempt_num_pre_cb_2: ' + attempt_num_pre_cb_2);
               attempt_num_pre_cb_2++;
            } else if ( max_attempts_pre_cb_2 != false && attempt_num_pre_cb_2 > max_attempts_pre_cb_2 ) {
               // We've exhausted all attempts, try callback_2 now (as long as it exists)!
               if ( $jObject_2.length > 0 ) {
                  console.log('Attempting callback_2 now...');
                  // Reset the attempt_num_pre_cb_2 counter
                  attempt_num_pre_cb_2 = 1;
                  // Attempt to do something via callback_2 function
                  callback_2($jObject_2);
               } else {
                  // We haven't found selector_1 yet, and now we cannot find selector_2, reset the counter and try again!
                  console.log('We haven\'t found selector_1 yet, and now we cannot find selector_2, so let\'s try again from the start...');
                  // Reset the attempt_num_pre_cb_2 counter
                  attempt_num_pre_cb_2 = 1;
               }
            }

            // Increament the total_num_attempts counter
            console.log( 'total_num_attempts: ' + total_num_attempts );
            total_num_attempts++;

            // Try again to find selector_1
            return;

         } else if ( $jObject_1.length < 1 && total_num_attempts > max_total_num_attempts ) {
            // We have reached the maximum total number of
            console.log('We\'ve reached the maximum number of attempts (' + total_num_attempts + ') to find selector_1, but didn\'t find it unfortunately. Pulling the plug now.');
            // Remove loading overlay
            $('.back-to-listing-overlay').remove();
            // Clear the interval
            clearInterval(poller1);
         }
            
         // We found selector_1!
         console.log('We found selector_1! Clear the interval and call function callback_1!');
         // Remove loading overlay
         $('.back-to-listing-overlay').remove();
         // Clear the interval
         clearInterval(poller1);
         // Call function callback_1!
         callback_1($jObject_1);

      },10);
   }

   /* Check if an element has a scrollbar */
   $.fn.hasScrollBar = function() {
      return this.get(0).scrollHeight > this.height();
   }

})(jQuery);