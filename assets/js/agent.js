//jQuery( document ).ready(function() {
	//console.log("document loaded");
	jQuery( window ).on( "load", function() {
		//console.log("window loaded");
		//alert(Lasius_refurl);
		
		// Setup of variables and names.
		// xoopsModule config name (cfn) is base
		// preload core var = cfn;
		// interval var = interValStart + _ + cfn;
		// title var = cfn + _ + title;
		// function name = cfn + Func();
			
			if (Lasius_reviveonlineusersblock > 0) {
				SystemBlock_checkOnlineUsers();
			}
		
			// start interval after 5000 ms			
			var interValStart_onlineusers = setInterval(SystemBlock_checkOnlineUsers, (Lasius_reviveonlineusersblock * 1000)); 
			var interValStart_topposters = setInterval(SystemBlock_checkTopPosters, (Lasius_revivetoppostersblock * 1000)); 
			var interValStart_newmembers = setInterval(SystemBlock_checkNewMembers, (Lasius_revivenewmembersblock * 1000)); 
			var interValStart_checkrecentcomments = setInterval(SystemBlock_checkRecentComments, (Lasius_reviverecentcommentsblock * 1000)); 
			var interValStart_recentpublisherarticles = setInterval(SystemBlock_checkRecentPublisherArticles, (Lasius_reviverecentpub_art_block * 1000)); 
			var interValStart_recentpublishernews = setInterval(SystemBlock_checkRecentPublisherNews, (Lasius_reviverecentpubnewsblock * 1000)); 
			var interValStart_reviverecnewbbpostsblk = setInterval(SystemBlock_checkRecentNewBBPosts, (Lasius_reviverecentnewbbpostsblock * 1000)); 
			var interValStart_reviverecentextcalminicalblocksblk = setInterval(SystemBlock_checkRecentExtCalMiniCal, (Lasius_reviverecentextcalminicalblock * 1000)); 
			var interValStart_reviveusermenublocksblk = setInterval(SystemBlock_checkusermenu, (Lasius_reviveusermenublock * 1000)); 
			var interValStart_reviveextcalupceventsblocksblk = setInterval(ExtcalBlock_upcomingEvents, (Lasius_reviveextcalupceventsblock * 1000)); 
			var interValStart_revivenewslatestnewsblocksblk = setInterval(NewsBlock_LatestNews, (Lasius_revivenewslatestnewsblock * 1000)); 
			var interValStart_revivebannerblocksblk = setInterval(BannerBlock_Banners, (Lasius_revivebannerblock * 1000)); 
			
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
				
				if (!interValStart_recentpublisherarticles) {
					interValStart_recentpublisherarticles = (Lasius_reviverecentpub_art_block > 0) ? setInterval(SystemBlock_checkRecentPublisherArticles, (Lasius_reviverecentpub_art_block * 1000)) : interValStart_recentpublisherarticles = undefined; 
				}
				
				if (!interValStart_recentpublishernews) {
					interValStart_recentpublishernews = (Lasius_reviverecentpubnewsblock > 0) ? setInterval(SystemBlock_checkRecentPublisherNews, (Lasius_reviverecentpubnewsblock * 1000)) : interValStart_recentpublishernews = undefined; 
				}
				
				if (!interValStart_reviverecnewbbpostsblk) {
					interValStart_reviverecnewbbpostsblk = (Lasius_reviverecentnewbbpostsblock > 0) ? setInterval(SystemBlock_checkRecentPublisherNews, (Lasius_reviverecentnewbbpostsblock * 1000)) : interValStart_reviverecnewbbpostsblk = undefined; 
				}
				
				if (!interValStart_reviverecentextcalminicalblocksblk) {
					interValStart_reviverecentextcalminicalblocksblk = (Lasius_reviverecentextcalminicalblock > 0) ? setInterval(SystemBlock_checkRecentPublisherNews, (Lasius_reviverecentextcalminicalblock * 1000)) : interValStart_reviverecentextcalminicalblocksblk = undefined; 
				}
				
				if (!interValStart_reviveusermenublocksblk) {
					interValStart_reviveusermenublocksblk = (Lasius_reviveusermenublock > 0) ? setInterval(SystemBlock_checkusermenu, (Lasius_reviveusermenublock * 1000)) : interValStart_reviveusermenublocksblk = undefined; 
				}
				
				if (!interValStart_reviveextcalupceventsblocksblk) {
					interValStart_reviveextcalupceventsblocksblk = (Lasius_reviveextcalupceventsblock > 0) ? setInterval(ExtcalBlock_upcomingEvents, (Lasius_reviveextcalupceventsblock * 1000)) : interValStart_reviveextcalupceventsblocksblk = undefined; 
				}
				
				if (!interValStart_revivenewslatestnewsblocksblk) {
					console.log("Latest news = " + Lasius_revivenewslatestnewsblock);
					interValStart_revivenewslatestnewsblocksblk = (Lasius_revivenewslatestnewsblock > 0) ? setInterval(SystemBlock_checkOnlineUsers, (Lasius_revivenewslatestnewsblock * 1000)):interValStart_revivenewslatestnewsblocksblk = undefined; 
				}
				
				if (!interValStart_revivebannerblocksblk) {
					console.log("Banner = " + Lasius_revivebannerblock);
					interValStart_revivebannerblocksblk = (Lasius_revivebannerblock > 0) ? setInterval(BannerBlock_Banners, (Lasius_revivebannerblock * 1000)):interValStart_revivebannerblocksblk = undefined; 
				}
			});

			// start searching dom for mutations f.i. from dynamic smarty includes
			mutationObserver.observe(document.documentElement, {
				characterData: true,
				childList: true,
				subtree: true,
				attributes: true
			});
			

			// Check new members block 
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
			
			// Check top posters
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

			// Check online users
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
			
			// Check recent articles.
			function SystemBlock_checkRecentPublisherArticles() {
					this.interValStart_recentpublisherarticles = undefined; //reset interval	
					if (Lasius_reviverecentpub_art_block > 0) {
						
						jQuery('div:contains("' + Lasius_reviverecentpub_art_block_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=recentpublisherarticles", function() {
						//console.log('replace  topposters block.');
						//console.log(Lasius_systemurl + "/agent.php?type=topposters");
						}).fadeIn('slow');
						
						jQuery('aside h4.block-title:contains("' + Lasius_reviverecentpub_art_block_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=recentpublisherarticles", function() {
							jQuery(this).prepend('<h4 class="block-title">' + Lasius_reviverecentpub_art_block_title + '</h4>');
								//console.log('replace  topposters block.');
								//console.log(Lasius_systemurl + "/agent.php?type=topposters");
						}).fadeIn('slow');
					}			
			}
			
			// Check recent articles.
			function SystemBlock_checkRecentPublisherNews() {
					this.interValStart_recentpublishernews = undefined; //reset interval	
					if (Lasius_reviverecentpubnewsblock > 0) {
						jQuery('div:contains("' + Lasius_reviverecentpubnewsblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=recentpublishernews", function() {
						console.log('replace  recent pub newe.');
						console.log(Lasius_systemurl + "/agent.php?type=recentpublishernews");
						}).fadeIn('slow');
						
						jQuery('aside h4.block-title:contains("' + Lasius_reviverecentpubnewsblock_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=recentpublishernews", function() {
							jQuery(this).prepend('<h4 class="block-title">' + Lasius_reviverecentpubnewsblock_title + '</h4>');
								//console.log('replace  topposters block.');
								//console.log(Lasius_systemurl + "/agent.php?type=topposters");
						}).fadeIn('slow');
					}			
			}
			
			// Check recent articles.
			function SystemBlock_checkRecentNewBBPosts() {
					this.interValStart_recentpublishernews = undefined; //reset interval	
					if (Lasius_reviverecentnewbbpostsblock > 0) {
						jQuery('div:contains("' + Lasius_reviverecentnewbbpostsblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=recentnewbbposts", function() {
						console.log('replace  recent pub newe.');
						console.log(Lasius_systemurl + "/agent.php?type=recentnewbbposts");
						}).fadeIn('slow');
						
						jQuery('aside h4.block-title:contains("' + Lasius_reviverecentnewbbpostsblock_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=recentnewbbposts", function() {
							jQuery(this).prepend('<h4 class="block-title">' + Lasius_reviverecentnewbbpostsblock_title + '</h4>');
								//console.log('replace  topposters block.');
								//console.log(Lasius_systemurl + "/agent.php?type=topposters");
						}).fadeIn('slow');
					}			
			}
			
			// Check recent articles.
			function SystemBlock_checkRecentExtCalMiniCal() {
					this.interValStart_reviverecentextcalminicalblocksblk = undefined; //reset interval	
					if (Lasius_reviverecentextcalminicalblock > 0) {
						jQuery('div:contains("' + Lasius_reviverecentextcalminicalblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=extcalminical", function() {
						console.log('replace  recent pub newe.');
						console.log(Lasius_systemurl + "/agent.php?type=extcalminical");
						}).fadeIn(1000);
						
						jQuery('aside h4.block-title:contains("' + Lasius_reviverecentextcalminicalblock_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=extcalminical", function() {
							jQuery(this).prepend('<h4 class="block-title">' + Lasius_reviverecentextcalminicalblock_title + '</h4>');
						}).fadeIn(1000);
					}			
			}
			
			
			function SystemBlock_checkusermenu() {
					this.interValStart_reviveusermenublocksblk = undefined; //reset interval	
					if (Lasius_reviveusermenublock > 0) {
						jQuery('div:contains("' + Lasius_reviveusermenublock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=usermenu", function() {
						console.log('replace  usermenu.');
						console.log(Lasius_systemurl + "/agent.php?type=usermenu");
						}).fadeIn(1000);
						
						jQuery('aside h4.block-title:contains("' + Lasius_reviveusermenublock_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=usermenu", function() {
							jQuery(this).prepend('<h4 class="block-title">' + Lasius_reviveusermenublock_title + '</h4>');
						}).fadeIn(1000);
					}			
			}

			function ExtcalBlock_upcomingEvents() {
				this.interValStart_reviveextcalupceventsblocksblk = undefined; //reset interval	
				if (Lasius_reviveextcalupceventsblock > 0) {
					jQuery('div:contains("' + Lasius_reviveextcalupceventsblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=upcevents", function() {
					console.log('replace  upcevents.');
					console.log(Lasius_systemurl + "/agent.php?type=upcevents");
					}).fadeIn(1000);
					
					jQuery('aside h4.block-title:contains("' + Lasius_reviveextcalupceventsblock_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=upcevents", function() {
						jQuery(this).prepend('<h4 class="block-title">' + Lasius_reviveextcalupceventsblock_title + '</h4>');
					}).fadeIn(1000);
				}			
			}
			
			function NewsBlock_LatestNews() {
				this.interValStart_revivenewslatestnewsblocksblk = undefined; //reset interval	
				if (Lasius_revivenewslatestnewsblock > 0) {
					jQuery('div:contains("' + Lasius_revivenewslatestnewsblock_title + '")').next(".blockContent").load(Lasius_systemurl + "/agent.php?type=newsrecentnews", function() {
					console.log('replace  newsrecentnews.');
					console.log(Lasius_systemurl + "/agent.php?type=newsrecentnews");
					}).fadeIn(1000);
					
					jQuery('aside h4.block-title:contains("' + Lasius_revivenewslatestnewsblock_title + '")').parent("aside").load(Lasius_systemurl + "/agent.php?type=newsrecentnews", function() {
						jQuery(this).prepend('<h4 class="block-title">' + Lasius_revivenewslatestnewsblock_title + '</h4>');
					}).fadeIn(1000);
				}			
			}
			
			function BannerBlock_Banners() {
				this.interValStart_revivebannerblocksblk = undefined; //reset interval
				if (Lasius_revivebannerblock > 0) {
					jQuery(".xoops-banner").each(function(){
						jQuery(jQuery(this).load(Lasius_systemurl + "/agent.php?type=banner", function() {					
							console.log('replace  banner.');
							console.log(Lasius_systemurl + "/agent.php?type=banner");
						})).fadeIn(1000);
						//jQuery(this).children(':first').unwrap();
					})
				}			
			}
			
			
	});
//});