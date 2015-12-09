jQuery(document).ready(function($) {

$( ".connect-websites .connect-button" ).toggle(function() {
  $(".connect-websites ul").addClass("animated fadeInRight");
  $(".connect-websites ul").removeClass("fadeOutRight");
}, function() {
  $(".connect-websites ul").addClass("animated fadeOutRight");
  $(".connect-websites ul").removeClass("fadeInRight");
});
$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="jQuery(this).parent().slideUp(function(){ jQuery(this).remove() }); return false">remove</a>';
$('a.add').relCopy({ append: removeLink});	
});

});
