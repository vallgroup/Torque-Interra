($ => {
   $(document).ready(() => {

      /**
       * This script is mainly used for pages which load a ReactJS interface with preloaded URL parameters.
       * The pre-loaded params means the user has to click the back button multiple times to return to the last page they were on.
       * This script resets the back button to the previous URL.
       */

      // Retreive previous URL
      const prevURL = document.referrer;
      // Setup re-useable variables
      const currUrl = window.location.pathname;
      const currUrlAndParams = window.location.pathname + window.location.search;;
      const isListingsArchivePage = currUrl.includes('/listings/'); // Are we on the /listings/ page?
      const isBlogArchivePage = currUrl.includes('/blog/'); // Are we on the /blog/ page?

      if ( isListingsArchivePage || isBlogArchivePage ) {
         // Reset the back buttons URL to the previous page
         history.pushState(null, null, currUrlAndParams);
         window.addEventListener('popstate', function(event) {
            window.location.assign(prevURL);
         });
      }
      
   });

})(jQuery);