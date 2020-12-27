/* Axel Web Dev */
/* MIT License - Copyright 2002-2021 */

/* Start Custom JQuery Functions */
(function ($) {

  /* All pages */
  /* Close flash message when clicking on itself */
  if (($(".content-successDiv").length) || ($(".content-errorDiv").length)) {
    /* Success message */
    $(".content-successDiv")
      .append("<div class='text-right w-100 m-0 p-0 pr-4' style='position:absolute; top:0.5rem'><i class='fas fa-times'></i></div>")
      .appendTo(".content-successDiv");
    $(".content-successDiv").on('click', function (_e) {
      $(".content-successDiv").remove();
    });
    /* Error message */
    $(".content-errorDiv")
      .append("<div class='text-right w-100 m-0 p-0 pr-4' style='position:absolute; top:0.5rem'><i class='fas fa-times'></i></div>")
      .appendTo(".content-errorDiv");
    $(".content-errorDiv").on('click', function (_e) {
      $(".content-errorDiv").remove();
    });
  }

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