(function( $ ) {
	'use strict';
	 
	$( window ).load(function() {
	
		//hide all the 'tab-content'
		$('.imcc-nav-tab-content').hide();
		
		//show 'tab-content' that is default
		$('.imcc-nav-tab-content[imcc-nav-tab-content=' + $('.nav-tab.nav-tab-active').attr('imcc-nav-tab-for') + ']').show();

		$('.nav-tab').click(function(){

			//hide all the 'tab-content'
			$('.imcc-nav-tab-content').hide();

			//manage the 'active-tab' class
			$('.nav-tab').removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');

			//show 'tab-content' for the pressed tab
			$('.imcc-nav-tab-content[imcc-nav-tab-content=' + $(this).attr('imcc-nav-tab-for') + ']').show();

		});

	});

	//initate codemirror instance
	var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('imcc-editor'), {
       	mode: "css",
       	lineNumbers: true,
       	lineWrapping: true,
       	theme : 'dracula',
      });

})( jQuery );
