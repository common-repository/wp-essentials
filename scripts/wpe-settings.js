jQuery(document).ready(function() {
	var baseURL="//"+window.location.hostname;
	var currentURL=window.location;
	var ajaxBase = '//www.wp-essentials.net/wp-ajax.php?slug=';
	
	if (jQuery("#wpe_left").length>0) {
		jQuery("#wpe_left").find('.postbox h3').each(function(){
			jQuery(jQuery(this).parent().get(0)).addClass('closed');
		}).not(".disabled").click(function() {
			var thisHeader = jQuery(this).parent();
			var ajaxURL = thisHeader.attr("data-url");
			var thisLink = jQuery(this);

			if (thisHeader.hasClass("closed")) {
				thisHeader.find("h3 span").append(' <i class="fa fa-refresh fa-fw fa-spin" aria-hidden="true"></i>');
				jQuery(thisHeader.find(".ajax-content")).load(ajaxBase+ajaxURL+" #ajax-content",function(){
					thisHeader.find("h3 .fa-refresh").remove();
					jQuery(thisHeader.get(0)).toggleClass('closed');
					jQuery(".wp-submenu .current").removeClass("current");
					jQuery(".wp-submenu a[href*='#"+thisLink.parent().attr("id")+"']").parent().addClass("current");
					jQuery(".pro_version_inner").each(function(){
						var thisPostbox = jQuery(this);
						if (thisPostbox.find("a").length==0) {
							thisPostbox.append(' <a href="http://www.wp-essentials.net" target="_blank"><i class="fa fa-lock"></i> Licence Required</a>');
						}
					});
				});
			} else {
				jQuery(thisHeader.get(0)).toggleClass('closed');
				jQuery(".wp-submenu .current").removeClass("current");
				jQuery(".wp-submenu a[href*='#"+thisLink.parent().attr("id")+"']").parent().addClass("current");
			}
		});
		jQuery("#wpe_total_user_roles").val(jQuery("#user_role_table tbody tr").length);
		jQuery("#wpe_total_image_sizes").val(jQuery("#image_size_table tbody tr").length);

		var rightPos = jQuery("#wpe_right").position();
		
		jQuery(".pro_version").each(function(){
			var thisPostbox = jQuery(this);
			thisPostbox.find("input").attr("disabled","disabled");
			thisPostbox.find("h3").append(' <a href="http://www.wp-essentials.net" target="_blank"><i class="fa fa-lock"></i> Licence Required</a>');
		});
		
		jQuery("#add_user_role").on("click",function(e){
			e.preventDefault();
			var dupe = jQuery("#user_role_table tbody tr:last").clone();
			var newRow = jQuery("#user_role_table tbody tr").length + 1;
			
			dupe.html(function(i, dupe) {
				return dupe
				.replace('Client', '')
				.replace(/[\d\.]+/g, newRow)
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('checked=""', '')
				.replace('disabled="disabled"', '');
			});
			
			jQuery("#wpe_total_user_roles").val(newRow);
			jQuery("#user_role_table tbody").append(dupe);
			jQuery("#user_role_table tbody tr:last input[type=text]").val("");
		});

		jQuery("#add_image_size").on("click",function(e){
			e.preventDefault();
			var dupe = jQuery("#image_size_table tbody tr:last").clone();
			var newRow = jQuery("#image_size_table tbody tr").length + 1;
			
			dupe.html(function(i, dupe) {
				return dupe
				.replace(/[\d\.]+/g, newRow)
				.replace('disabled="disabled"', '')
				.replace('checked=""', '');
			});
			
			jQuery("#wpe_total_image_sizes").val(newRow);
			jQuery("#image_size_table tbody").append(dupe);
			jQuery("#image_size_table tbody tr:last input[type=text]").val("");
		});
		
		jQuery(".delete_image_size").live("click",function(e){
			e.preventDefault();
			jQuery(this).parent('td').parent('tr').fadeOut(function(){
				jQuery(this).remove();
				var oldRow = jQuery("#wpe_total_image_sizes").val();
				var newRow = oldRow - 1;
				jQuery("#wpe_total_image_sizes").val(newRow);
				
				var numRows = 1;
				jQuery("#image_size_table tbody tr").each(function(){
					var thisRow = jQuery(this);
					thisRow.html(thisRow.html());
					thisRow.find("input:eq(0)").attr("name",numRows+"_image_name");
					thisRow.find("input:eq(1)").attr("name",numRows+"_image_width");
					thisRow.find("input:eq(2)").attr("name",numRows+"_image_height");
					thisRow.find("input:eq(3)").attr("name",numRows+"_image_crop");
					numRows++;
				});
			});
		});

		jQuery("#wpe-settings-form").on("submit",function(){
			jQuery(".fa-refresh").addClass("fa-spin");
		});
		
		// # Navigation
			if (window.location.hash) {
				jQuery(window.location.hash+" h3").each(function() {
					var thisHeader = jQuery(this).parent();
					var ajaxURL = thisHeader.attr("data-url");
					var thisLink = jQuery(this);

					if (thisHeader.hasClass("closed")) {
						thisHeader.find("span").append(' <i class="fa fa-refresh fa-fw fa-spin" aria-hidden="true"></i>');
						jQuery(thisHeader.find(".ajax-content")).load(ajaxBase+ajaxURL+" #ajax-content",function(){
							thisHeader.find(".fa-refresh").remove();
							jQuery(thisHeader.get(0)).toggleClass('closed');
							jQuery(".wp-submenu .current").removeClass("current");
							jQuery(".wp-submenu a[href*='#"+thisLink.parent().attr("id")+"']").parent().addClass("current");
							jQuery(".pro_version_inner").each(function(){
								var thisPostbox = jQuery(this);
								if (thisPostbox.find("a").length==0) {
									thisPostbox.append(' <a href="http://www.wp-essentials.net" target="_blank"><i class="fa fa-lock"></i> Licence Required</a>');
								}
							});
							jQuery("html, body").animate({ scrollTop: (jQuery(window.location.hash).offset().top-60) }, 1000);
						});
					} else {
						jQuery(thisHeader.get(0)).toggleClass('closed');
						jQuery(".wp-submenu .current").removeClass("current");
						jQuery(".wp-submenu a[href*='#"+thisLink.parent().attr("id")+"']").parent().addClass("current");
						jQuery(".pro_version_inner").each(function(){
							var thisPostbox = jQuery(this);
							if (thisPostbox.find("a").length==0) {
								thisPostbox.append(' <a href="http://www.wp-essentials.net" target="_blank"><i class="fa fa-lock"></i> Licence Required</a>');
							}
						});
						jQuery("html, body").animate({ scrollTop: (jQuery(window.location.hash).offset().top-60) }, 1000);
					}
				});
			}
		
		// Submenu
			jQuery(".wp-submenu a[href*='wp-essentials']").on("click",function(e){
				var url = jQuery(this).attr("href");
				var hash = url.substring(url.indexOf('#'));
				var thisLink = jQuery(this);
				
				jQuery("#wpe_left h3").each(function() {
					jQuery(this).parent().addClass('closed');
				});
				
				jQuery(".wp-submenu .current").removeClass("current");
				thisLink.parent().addClass("current");
				
				jQuery(hash+" h3").each(function() {
					var thisHeader = jQuery(this).parent();
					var ajaxURL = thisHeader.attr("data-url");

					if (thisHeader.hasClass("closed")) {
						thisHeader.find("span").append(' <i class="fa fa-refresh fa-fw fa-spin" aria-hidden="true"></i>');
						jQuery(thisHeader.find(".ajax-content")).load(ajaxBase+ajaxURL+" #ajax-content",function(){
							thisHeader.find(".fa-refresh").remove();
							jQuery(thisHeader.get(0)).toggleClass('closed');
							jQuery(".pro_version_inner").each(function(){
								var thisPostbox = jQuery(this);
								if (thisPostbox.find("a").length==0) {
									thisPostbox.append(' <a href="http://www.wp-essentials.net" target="_blank"><i class="fa fa-lock"></i> Licence Required</a>');
								}
							});
							jQuery("html, body").animate({ scrollTop: (jQuery(window.location.hash).offset().top-60) }, 1000);
						});
					} else {
						jQuery(thisHeader.get(0)).toggleClass('closed');
						jQuery(".pro_version_inner").each(function(){
							var thisPostbox = jQuery(this);
							if (thisPostbox.find("a").length==0) {
								thisPostbox.append(' <a href="http://www.wp-essentials.net" target="_blank"><i class="fa fa-lock"></i> Licence Required</a>');
							}
						});
						jQuery("html, body").animate({ scrollTop: (jQuery(window.location.hash).offset().top-60) }, 1000);
					}
				});
			});
		
		// Image Quality
			jQuery("#wpe-slider").slider({
				value:jQuery("#wpe-slider-label").text(),
				min:0,
				max:100,
				step:1,
				slide:function(event,ui) {
					jQuery("#wpe-slider-label").text(ui.value);
					jQuery("#image_quality").val(ui.value);
					jQuery(".image-1").css("opacity",(ui.value/100));
				}
			});
			jQuery("#image_quality").hide();
			
		// Styling
			jQuery("#none").on("click",function(){
				jQuery(".style_css,.style_sass,.style_less").hide();
			});
			jQuery("#css").on("click",function(){
				jQuery(".style_sass,.style_less").hide();
				jQuery(".style_css").fadeIn();
			});
			jQuery("#sass").on("click",function(){
				jQuery(".style_css,.style_less").hide();
				jQuery(".style_sass").fadeIn();
			});
			jQuery("#less").on("click",function(){
				jQuery(".style_sass,.style_css").hide();
				jQuery(".style_less").fadeIn();
			});
	}
});