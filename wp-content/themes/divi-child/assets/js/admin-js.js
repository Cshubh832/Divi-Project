	/*
     * Media button
     */
	 
	
	jQuery(document).ready(function() {
		var $ = jQuery;
		if ($('.set_custom_images').length > 0) {
			if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
				$('.set_custom_images').on('click', function(e) {
					e.preventDefault();
					var button = $(this);
					var id = button.prev();
					wp.media.editor.send.attachment = function(props, attachment) {
						id.val(attachment.url);
						$(".custom-legal-notice-add-media-wr").attr('src', attachment.url);
						$(".wp-legalease-media-wrapper").html('<img src="' + attachment.url + '" class="custom-legal-notice-add-media-wr"/>');
					};
					wp.media.editor.open(button);
					return false;
				});
			}
		}
		$('.wp-legalease-delete-digital-img').on('click', function () {
        $(this).next().attr('src', '');
        $('input[name=custom-legal-notice-add-media]').attr('value', '');
    });
	});