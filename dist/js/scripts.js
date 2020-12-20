/* Video pause when modal close */
(function ($) {
  $('.modal').on('hidden.bs.modal', function (_e) {
    $iframe = $(this).find("iframe");
    $iframe.attr("src", $iframe.attr("src"));
  });
})(jQuery);

/* Recaptcha Callback */
function onSubmit(token) {
  document.getElementById("validate-form").submit()
}
