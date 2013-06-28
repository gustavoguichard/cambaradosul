jQuery(function() {
		
	jQuery('body').removeClass('no-js')

	jQuery('#nav_container').append('<ul id="submenu"></ul>');
	
	jQuery('#submenu').hide();
		
	jQuery('#nav li').click(function(e){
		href = jQuery(this).find('a').attr('href');
		if(href == '#') e.preventDefault();
		if(!jQuery(this).hasClass('current')){
			jQuery('#nav li').removeClass('current');
			jQuery(this).addClass('current');	
			$html = jQuery(this).find('ul.sub-menu').html();
			jQuery('#submenu').html($html).hide().slideDown();
		} else {
			jQuery('#nav li').removeClass('current');
			jQuery('#submenu').slideUp();
		}
	})
	
	jQuery('dl.gallery-item').each(function(){
		if(!jQuery(this).parent().parent().hasClass('videos_item') && !jQuery(this).hasClass('aligncenter')){
			var $deg = randomRotate();
			jQuery(this).css({
		      '-moz-transform': randomRotate(),
		      '-webkit-transform': randomRotate(),
		      '-o-transform': randomRotate(),
		      'transform': randomRotate()
		    });
		}
	});
	jQuery('a[rel*=lightbox]').lightBox({maxHeight: 550, maxWidth: 800});
	
	function randomRotate(){
		var $i = 'rotate(';
		$i += Math.ceil(Math.random()*4)-2;
		$i += 'deg)';
		
		return $i;
	}	
});