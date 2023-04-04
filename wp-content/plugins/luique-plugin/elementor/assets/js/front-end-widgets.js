(function ($) {
	"use strict";

	/* Init Elementor Front Scripts */
	$(window).on('elementor/frontend/init', function () {
		
		// Widgets
		elementorFrontend.hooks.addAction( 'frontend/element_ready/luique-hero-slider.default', function() {
			var editorActive = $('body').hasClass('elementor-editor-active');
			if ( editorActive ) {
				
			}
		} );

		// Global
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
			
		} );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function( $scope ) {
			var editorActive = $('body').hasClass('elementor-editor-active');
			if( editorActive ) {
				
			}
		} );
	});
})(jQuery);