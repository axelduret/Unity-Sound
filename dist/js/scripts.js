/* Start Custom JQuery Functions */
(function ($) {

  /* Video page */
  /* Video pause when closing modal */
  $('.modal').on('hidden.bs.modal', function (_e) {
    $iframe = $(this).find("iframe");
    $iframe.attr("src", $iframe.attr("src"));
  });

  /* Video admin page */
  /* Open modal on enter key press */
  if ($("#previewButton").length) {
    $('input').on('keypress', (event) => {
      if (event.which === 13) {
        event.preventDefault();
        $('#previewButton').click();
      }
    });
  }

  /* Video admin page */
  /* Display form content inside modal when clicking on preview button */
  $("#previewButton").on('click', function (_e) {
    if ($("#title").val() != "" && $("#episode").val() != "" && $("#date").val() != "" && $("#artist").val() != "" && $("#url").val() != "") {
      $("#previewModal").modal('show');
      $("#previewModal").modal(
        $("#videoTitle").html(
          $("#title").val()
        ) +
        $("#videoEpisode").html(
          $("#episode").val()
        ) +
        $("#videoDate").html(
          $("#date").val()
        ) +
        $("#videoArtist").html(
          "Feat. " + $("#artist").val()
        ) +
        $("#videoUrl").attr("src",
          "https://img.youtube.com/vi/" + $("#url").val() + "/hqdefault.jpg"
        )
      );
    } else {
      alert("Remplir tous les champs avant de valider");
    }
  });

})(jQuery);
/* End Custom JQuery Functions */

/* Login and register page */
/* Recaptcha Callback */
function onSubmit(token) {
  document.getElementById("validate-form").submit()
}