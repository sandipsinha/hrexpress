$(document).ready(function(){
$("#van-one li").hover(
function(){ $("ul", this).fadeIn("slow"); }, 
function() { } 
);
if (document.all) {
$("#van-one li").hoverClass ("sfHover");
}
});

$.fn.hoverClass = function(c) {
return this.each(function(){
$(this).hover( 
function() { $(this).addClass(c); },
function() { $(this).removeClass(c); }
);
});
}; 