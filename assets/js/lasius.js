jQuery(document).ready(function () {
	/*
	 * Overtake the pop-up messages and use jqueryUi dialog instead
	 * return false
	 */
	if (Lasius_usepopups > 0) {
		jQuery(document).on('click','a', function( event ) {
			
			// Selector = online users pop up
			// ---- start ----
			if (this.href.indexOf('showpopups&type=online') != -1) {
					event.preventDefault();
					jQuery( "#lasius_ou" ).dialog( "destroy" ); // Close any existing dialogues before opening new		
					// remove part of user id links that opens pop-up
					var url = this.href;
					var newurl = url.replace("javascript:openWithSelfMain('", "").replace("','Online',420,350);","");
				
				// initiate jquery UI dialog
				jQuery('<div id="lasius_ou">').dialog({			
					modal: false,
					open: function ()
					{
						jQuery("#lasius_ou").hide(); // hide html until load and manipulation is done
						jQuery(this).load(newurl, function() {
							jQuery(this).css("height", "auto");
							jQuery("#lasius_ou").find("tr").first().remove(); // remove tr holding html th
							jQuery("#lasius_ou").find("img").css({ 'height': '25px' }); // set avatar to 25px height
							jQuery("#lasius_ou").find("input.formButton").parent().remove(); // remove html close button
							jQuery("#lasius_ou").find("table").removeClass("outer").addClass("even"); // remove css from table
							
							// iterate all links and remove any pop-up parts and leave clean html url
							jQuery("#lasius_ou a").each(function() {
								var nu = jQuery(this).attr("href").replace("javascript:window.opener.location='", "").replace("';window.close();","");
								jQuery(this).attr("href", nu);
							});
							
						}).fadeIn(2000); // fade in new mainupulated html
					},
					title: Lasius_reviveonlineusersblock_title // set dialog title			
				});
					return false;
			}
			// ---- end ----
		});
	}

});