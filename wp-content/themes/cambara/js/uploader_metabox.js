jQuery(document).ready(function() {
	var formfield = false;
	var $pdf_input;

	jQuery('.upload_pdf_button').click(function() {
		jQuery('html').addClass('upload_pdf');
		var $cont = jQuery(this).parent();
		$pdf_input = jQuery('input[type=text]', $cont);
		formfield = $pdf_input.attr('name');
		tb_show('', 'media-upload.php?type=file&TB_iframe=true');
		tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Usar arquivo');}, 2000);
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = custom_send_to_editor;
		return false;
	});

	// user inserts file into post. only run custom if user started process using the above process
	// window.send_to_editor(html) is how wp would normally handle the received data
	
	function custom_send_to_editor(html){
		clearInterval(tbframe_interval);
		if (formfield) {
			fileurl = jQuery(html).attr('href');
			console.log(fileurl);
				$pdf_input.val(fileurl);

			tb_remove();

			formfield = null;
			jQuery('html').removeClass('upload_pdf');

		} else {
			window.original_send_to_editor(html);
		}
	};

});