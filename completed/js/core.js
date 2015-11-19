var starRating = {
	ul_classes : 'stars',
	rate_classes : 'rate-1 rate-2 rate-3 rate-4 rate-5',
	showHover : function(obj, event) {
		var rel_class = $(obj).attr('rel');
		var ul_parent = $(obj).closest('ul');				
		if (event.type == "mouseover") {	
			this.ul_classes = ul_parent.attr('class');
			ul_parent.removeClass(starRating.rate_classes);
			ul_parent.addClass(rel_class);
		} else {			
			ul_parent.attr('class', starRating.ul_classes);
		}
	},
	saveRating : function(obj) {
		var rel_class = $(obj).attr('rel');
		var ul_parent = $(obj).closest('ul');
		var ul_parent_id = ul_parent.attr('id').split('_');
		$.getJSON('/mod/rate.php?id='+ul_parent_id[1]+'&class='+rel_class, function(data) {
			if (!data.error) {
				ul_parent.replaceWith(data.container);
				$('#votes_'+ul_parent_id[1]).html(data.votes);
			}
		});
	}
}
$(document).ready(function() {
	
	$('.stars li a').live('mouseover mouseout', function(event) {		
		starRating.showHover($(this), event);		
	});
	
	$('.stars li a').live('click', function() {		
		starRating.saveRating($(this));	
		return false;	
	});
	
});