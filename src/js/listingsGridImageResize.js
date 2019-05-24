($ => {
   $(document).ready(() => {

      console.log('listingsGridImageResize.js loaded...');
      
      // Set constant vars
      const listing_grid_iamges = '.loop-post .featured-image-wrapper'; // Both Listings & Blogs covered here...
      const height_to_width_ratio = 0.75; // 4:3 landscape ratio

      // On load ensure image ratio is correct

      resetImageRatio(listing_grid_iamges, height_to_width_ratio, 500);

      // On resize ensure image ratio is correct
      $(window).resize(function(){
         resetImageRatio(listing_grid_iamges, height_to_width_ratio, 500);
      });

   });

   function resetImageRatio( $elements_selector, $heightToWidthRatio = 1, $maxAttempts = 1000 ) {

      var $currAttempt = 1;
      
      var poller1 = setInterval(function(){
      
         // Setup jQuery objects for the two selectors, each interval
         $elements = $($elements_selector);

         if ( $elements.length < 1 && $currAttempt <= $maxAttempts ) {
            
            console.log('$currAttempt: ' + $currAttempt);
            $currAttempt++;

            return;

         } else if ( $elements.length < 1 && $currAttempt > $maxAttempts ) {

            // Clear the interval
            clearInterval(poller1);

         }

         console.log('Found elements!');

         $elements.each(function(){
            var newHeight = $(this).width() * $heightToWidthRatio;
            // With each, reset the image ratio
            $(this)
               .css({
                  'transition':  '0.2s',
                  'width':       '100%',
                  'max-height':  newHeight,
                  'min-height':  newHeight,
                  'height':      newHeight
               });
         });
         
         // Clear the interval
         clearInterval(poller1);

      },10);

   }

})(jQuery);