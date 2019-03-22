($ => {
  $(document).ready(() => {
    const headerContent = $("header .torque-header-content-wrapper");
    const headerSearchForm = headerContent.find("form.searchform");

    if (headerContent && headerSearchForm) {
      headerSearchForm.click(function(e) {
        headerContent.toggleClass("searchform-open");
        $(this).toggleClass("closed");
      });

      headerSearchForm.find("input").click(function(e) {
        e.stopPropagation();
      });
    }
  });
})(jQuery);
