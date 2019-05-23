($ => {
  $(document).ready(() => {
    const headerContent = $("header .torque-header-content-wrapper");
    const headerSearchForm = headerContent.find("form.searchform");
    const outsideSearchForm = $("main");

    if (headerContent && headerSearchForm) {
      headerSearchForm.click(function(e) {
        headerContent.toggleClass("searchform-open");
        $(this).toggleClass("closed");
      });

      headerSearchForm.find("input").click(function(e) {
        e.stopPropagation();
      });

      // When user clicks outside of search form
      outsideSearchForm.click(function(){
        // If the form is open
        if ( headerContent.hasClass("searchform-open") ) {
          // Close it...
          headerContent.toggleClass("searchform-open");
          headerSearchForm.toggleClass("closed");
        }
      });
    }
  });
})(jQuery);
