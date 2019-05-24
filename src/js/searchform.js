($ => {
  $(document).ready(() => {
    const headerContent = $("header .torque-header-content-wrapper");
    const headerSearchForm = headerContent.find("form.searchform");
    const headerSearchFormInput = headerSearchForm.find("input");
    const outsideSearchForm = $("main");

    if (headerContent && headerSearchForm) {
      headerSearchForm.click(function(e) {
        headerContent.toggleClass("searchform-open");
        $(this).toggleClass("closed");
        // If we've opened the search form then forcus on it...
        if ( headerContent.hasClass("searchform-open") ) {
          headerSearchFormInput.focus();
        }
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
