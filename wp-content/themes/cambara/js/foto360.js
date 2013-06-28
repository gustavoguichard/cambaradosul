jQuery(function() {		
	jQuery('#bannerFlash').wrap(function(){
		var canions = ['itaimbezinho', 'fortaleza'];
		return '<iframe src="http://cambaradosul.rs.gov.br/flash/'+canions[Math.floor(Math.random()*canions.length)]+'.html" name="shot360" width="960" height="300" scrolling="no"/>';
	})
});