$(document).ready(function(){
    
    $(".rubLabel input").click(function(e){
        e.preventDefault();
    })
    
	$(".niceCheck").closest("label").mousedown(function() {
		 changeCheck($(this).find(".niceCheck"));
	});
	$(".niceCheck").closest("label").each(function() {
		 changeCheckStart($(this).find(".niceCheck"));
	});
});

function changeCheck(el) {
     var el = el,
          input = el.find("input").eq(0);
   	 if(!input.attr("checked")) {
		el.css("background-position","0 -20px");
		el.closest("label").addClass("active");
		input.attr("checked", "checked")
	} else {
		el.css("background-position","0 0");
		el.closest("label").removeClass("active");
		input.removeAttr("checked");
	}
     return true;
}

function changeCheckStart(el) {
var el = el,
		input = el.find("input").eq(0);
        if(input.attr("checked")) {
		  el.css("background-position","0 -20px");
		  el.closest("label").addClass("active");
		}
     return true;
}