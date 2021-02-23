jQuery(document).ready(function () {
		var configonoroff;
		var configname;
		var configid;
		var configvalue;

    jQuery(document).on('change', "input[name='activatedonoff']", function(){
        configonoroff = jQuery(this).attr('id'); // get id
		configname = jQuery(this).attr('name');
		configid = jQuery(this).attr('id');
		configvalue = jQuery("select[name*='dropdown"+configname+"']").val();
		
		if (jQuery(this).is(':checked')) {
		  configonoroff = 1; // get id
		  configvalue = jQuery("select[name='dropdown"+configid+"']").val(); // get value
		} else {
		  configonoroff = 0; // get id
		  jQuery("select[name='dropdown"+configid+"']").val("0").change(); // set to key 0 on off
		}

		// Send post
        //doAjax(configonoroff, configid, configname, configvalue);
    });
	
	jQuery("select[name^='dropdown']").change(function() {
		configvalue = jQuery(this).val(); // get value
		configid = jQuery(this).attr('id');
		configname = jQuery(this).attr('name');
		if (jQuery("[name = 'activatedonoff'][id = '"+configid+"']").is(':checked')) {
			if (configvalue == 0 || configvalue == undefined) {
				jQuery("[name = 'activatedonoff'][id = '"+configid+"']").prop( "checked", false );
				configonoroff = 0; // get id
			} 			
		} else {
		  if (configvalue > 0 || configvalue == !undefined) {
				jQuery("[name = 'activatedonoff'][id = '"+configid+"']").prop( "checked", true );
				configonoroff = 1; // get id
			}
		}
		// Send post
		doAjax(configonoroff, configid, configname, configvalue);
	});
	
	/*
	 * Function to do the mailing
	 *
	 * @param int configonoroff		0 for disapled, 1 for activated
	 * @param string configid		the id of selected block
	 * @param string configname		name of selector
	 * @param int configvalue		value of drop down
	 * @return void
	 */
	function doAjax(configonoroff, configid, configname, configvalue) {
		jQuery.ajax({ 
            url: 'action.php',
            data: { 
				configactive:configonoroff, 
				configid: configid, 
				configname: configname,
				configvalue:configvalue
			},
            type: 'post'
        }).done(function(responseData) {
            //console.log('Done: ', responseData);
        }).fail(function() {
            //console.log('Failed');
        });
	}
	
});