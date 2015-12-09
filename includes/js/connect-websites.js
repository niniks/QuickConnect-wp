jQuery(document).ready(function($) {

$( ".connect-websites .connect-button" ).toggle(function() {
  $(".connect-websites ul").addClass("animated fadeInRight");
  $(".connect-websites ul").removeClass("fadeOutRight");
}, function() {
  $(".connect-websites ul").addClass("animated fadeOutRight");
  $(".connect-websites ul").removeClass("fadeInRight");
});

});
