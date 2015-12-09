jQuery(document).ready(function($) {

$(function(){
  var removeLink = ' <a class="remove" href="#" onclick="jQuery(this).parent().slideUp(function(){ jQuery(this).remove() }); return false">remove</a>';
$('a.add').relCopy({ append: removeLink});	
});

$('.rainbowpick').rgbacolorpicker();

});
