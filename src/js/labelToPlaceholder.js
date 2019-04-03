($ => {
  $(document).ready(() => {
    $(".grunion-field-wrap").each(function() {
      const label = $(this)
        .find("label")
        .first();

      const name = $(label)
        .find("span")
        .remove();

      if (name) {
        $(this)
          .find("input, textarea")
          .attr("placeholder", $(label).html());
      }
    });
  });
})(jQuery);
