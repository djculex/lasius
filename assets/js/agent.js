jQuery( document ).ready(function() {
	//console.log("document loaded");
	jQuery( window ).on( "load", function() {
		//console.log("window loaded");
		//alert(Lasius_refurl);
		
			// start interval after 10000 ms			
			var interValStart_onlineusers = setInterval(SystemBlock_checkOnlineUsers, 5000); 
			var interValStart_topposters = setInterval(SystemBlock_checkTopPosters, 5000); 
			var interValStart_newmembers = setInterval(SystemBlock_checkNewMembers, 5000); 
			var interValStart_checkrecentcomments = setInterval(SystemBlock_checkRecentComments, 5000); 
			
			
			var mutationObserver = new MutationObserver(function(mutations) {
			  mutations.forEach(function(mutation) {
				//console.log(mutation);
			  });
			  // while interalstart not set do nothing
			  //console.log("Online should be closed = " + Lasius_reviveonlineusersblock);
				if (!interValStart_onlineusers) {
					console.log("Online = " + Lasius_reviveonlineusersblock);
					interValStart_onlineusers = (Lasius_reviveonlineusersblock > 0) ? setInterval(SystemBlock_checkOnlineUsers, (Lasius_reviveonlineusersblock * 1000)):interValStart_onlineusers = undefined; 
				}
				
				if (!interValStart_topposters) {
					interValStart_topposters = (Lasius_revivetoppostersblock > 0) ? setInterval(SystemBlock_checkTopPosters, (Lasius_revivetoppostersblock * 1000)) : interValStart_topposters = undefined; 
				}
				
				if (!interValStart_newmembers) {
					interValStart_newmembers = (Lasius_revivenewmembersblock > 0) ? setInterval(SystemBlock_checkNewMembers, (Lasius_revivenewmembersblock * 1000)) : interValStart_newmembers = undefined; 
				}
				
				if (!interValStart_checkrecentcomments) {
					interValStart_checkrecentcomments = (Lasius_reviverecentcommentsblock > 0) ? setInterval(SystemBlock_checkRecentComments, (Lasius_reviverecentcommentsblock * 1000)) : interValStart_checkrecentcomments = undefined; 
				}
				
			});

			// start searching dom for mutations f.i. from dynamic smarty includes
			mutationObserver.observe(document.documentElement, {
				characterData: true,
				childList: true,
				subtree: true,
				attributes: true
			});
			
			// Check online users function called with interval.
			
			function SystemBlock_checkNewMembers() {
				this.interValStart_newmembers = undefined; //reset interval				
				if (Lasius_revivenewmembersblock_title > 0) {
					jQuery('div:contains("' + Lasius_revivenewmembersblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=newmembers", function() {
						//console.log('replace  new members block.');
						//console.log(Lasius_systemurl + "/agent.php?type=newmembers");
					}).fadeIn('slow');
					
					jQuery('aside h4.block-title:contains("' + Lasius_revivenewmembersblock_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=newmembers", function() {
						jQuery(this).prepend('<h4 class="block-title">' + Lasius_revivenewmembersblock_title + '</h4>');
							//console.log('replace  topposters block.');
							//console.log(Lasius_systemurl + "/agent.php?type=topposters");
					}).fadeIn('slow');					
				}
				
			}
			
			function SystemBlock_checkTopPosters() {
				this.interValStart_topposters = undefined; //reset interval			
				if (Lasius_revivetoppostersblock > 0) {
					jQuery('div:contains("' + Lasius_revivetoppostersblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=topposters", function() {
						//console.log('replace  topposters block.');
						//console.log(Lasius_systemurl + "/agent.php?type=topposters");
					}).fadeIn('slow');
					
					jQuery('aside h4.block-title:contains("' + Lasius_revivetoppostersblock_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=topposters", function() {
						jQuery(this).prepend('<h4 class="block-title">' + Lasius_revivetoppostersblock_title + '</h4>');
							//console.log('replace  topposters block.');
							//console.log(Lasius_systemurl + "/agent.php?type=topposters");
					}).fadeIn('slow');
				}
					
			}

			// function called with interval.
			function SystemBlock_checkOnlineUsers() {
					// if interval is set do smarty include
					this.interValStart_onlineusers = undefined; //reset interval	
					if (Lasius_reviveonlineusersblock > 0) {
						jQuery('div:contains("' + Lasius_reviveonlineusersblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=onlinenow&name="+Lasius_refurl, function() {
							//console.log('replace online users block.');
							//console.log(Lasius_systemurl + "/agent.php?type=onlinenow");
						}).fadeIn('slow');
						
						
						jQuery('.block-title:contains("' + Lasius_reviveonlineusersblock_title + '")').parent().load(Lasius_systemurl + "/agent.php?type=onlinenow&name="+Lasius_refurl, function() {
							jQuery(this).prepend('<h4 class="block-title">' + Lasius_reviveonlineusersblock_title + '</h4>');
							//console.log('replace online users block.');
							//console.log(Lasius_systemurl + "/agent.php?type=onlinenow");
						}).fadeIn('slow');
						
					}
								
			}
			
			// Check recent comments.
			function SystemBlock_checkRecentComments() {
					this.interValStart_topposters = undefined; //reset interval	
					if (Lasius_reviverecentcommentsblock > 0) {
						jQuery('div:contains("' + Lasius_reviverecentcommentsblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=recentcomments", function() {
						//console.log('replace  topposters block.');
						//console.log(Lasius_systemurl + "/agent.php?type=topposters");
						}).fadeIn('slow');
						
						jQuery('aside h4.block-title:contains("' + Lasius_reviverecentcommentsblock_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=recentcomments", function() {
							jQuery(this).prepend('<h4 class="block-title">' + Lasius_reviverecentcommentsblock_title + '</h4>');
								//console.log('replace  topposters block.');
								//console.log(Lasius_systemurl + "/agent.php?type=topposters");
						}).fadeIn('slow');
					}
								
			}
	});
});