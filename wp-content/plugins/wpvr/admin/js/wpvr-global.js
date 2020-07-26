(function( $ ) {
	'use strict';
	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

  $(document).ready(function(){
		$('.setup-wizard-carousel').owlCarousel({
            loop:false,
            nav:true,
            items:1,
            dots: false,
            mouseDrag: false,
            touchDrag: false,
            navText: ['Previous','Next'],
        });


        /*$(".choose-tour input[type='radio']").change(function(){
            var val = $(this).val();
            if($(this).is(":checked") ){
                console.log(val);
                $('#'+val).show();
            }else{
                $('#'+val).siblings().hide();
            }
        });*/

        $(".choose-tour input[type='radio']").on('click', function(){
            var val = $(this).val();
            $('#'+val).show();
            $('#'+val).siblings().hide();
        });
	});

	$(document).on("click","#wpvr-dismissible",function(e) {

		e.preventDefault();
		var ajaxurl = wpvr_global_obj.ajaxurl;
			jQuery.ajax({
					type:    "POST",
					url:     ajaxurl,
					data: {
						action: "wpvr_notice",
					},
					success: function( response ){
						$('#wpvr-warning').hide();
					}
		});
	});


})( jQuery );
