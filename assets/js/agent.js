jQuery( document ).ready(function() {
	//console.log("document loaded");
	jQuery( window ).on( "load", function() {
		//console.log("window loaded");
		//alert(Lasius_refurl);

			// start interval after 10000 ms			
			var interValStart_onlineusers = setInterval(SystemBlock_checkOnlineUsers, 5000); 
			var interValStart_topposters = setInterval(SystemBlock_checkTopPosters, 5000); 
			var interValStart_newmembers = setInterval(SystemBlock_checkNewMembers, 5000); 
			
			var mutationObserver = new MutationObserver(function(mutations) {
			  mutations.forEach(function(mutation) {
				//console.log(mutation);
			  });
			  // while interalstart not set do nothing
				if (!interValStart_onlineusers) {
					interValStart_onlineusers = (Lasius_reviveonlineusersblock > 0) ? setInterval(SystemBlock_checkOnlineUsers, Lasius_reviveonlineusersblock):interValStart_onlineusers = undefined; 
				}
				
				if (!interValStart_topposters) {
					interValStart_topposters = (Lasius_revivetoppostersblock > 0) ? setInterval(SystemBlock_checkTopPosters, Lasius_revivetoppostersblock) : interValStart_topposters = undefined; 
				}
				
				if (!interValStart_newmembers) {
					interValStart_newmembers = (Lasius_revivenewmembersblock > 0) ? setInterval(SystemBlock_checkNewMembers, Lasius_revivenewmembersblock) : interValStart_newmembers = undefined; 
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
				jQuery('div:contains("' + Lasius_revivenewmembersblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=newmembers", function() {
					//console.log('replace  new members block.');
					//console.log(Lasius_systemurl + "/agent.php?type=newmembers");
				}).fadeIn('slow');
				this.interValStart_newmembers = undefined; //reset interval				
			}
			
			function SystemBlock_checkTopPosters() {
				jQuery('div:contains("' + Lasius_revivetoppostersblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=topposters", function() {
					//console.log('replace  topposters block.');
					//console.log(Lasius_systemurl + "/agent.php?type=topposters");
				}).fadeIn('slow');
				this.interValStart_topposters = undefined; //reset interval				
			}

			// function called with interval.
			function SystemBlock_checkOnlineUsers() {
					/*
					jQuery(
						'div:contains("'+Lasius_reviveonlineusers_searcharray[0]+'")' && 
						'div:contains("'+Lasius_reviveonlineusers_searcharray[1]+'")' && 
						'div:contains("'+Lasius_reviveonlineusers_searcharray[2]+'")').load(Lasius_systemurl + "/agent.php?type=onlinenow", function() {
							console.log('replace online users block.');
						}).fadeIn('slow');
					*/
					jQuery('div:contains("' + Lasius_reviveonlineusersblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=onlinenow&name="+Lasius_refurl, function() {
						//console.log('replace online users block.');
						//console.log(Lasius_systemurl + "/agent.php?type=onlinenow");
					}).fadeIn('slow');
					// if interval is set do smarty include
					this.interValStart_onlineusers = undefined; //reset interval				
			}
	});
});