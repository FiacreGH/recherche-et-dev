/**
 * Toggle visibility of "read-more-content" block.
 * Example: http://bootstrap.ecodev.ch/content-examples/text-expandable/
 */
(function ($) {
	$(function () {
		$(document).ready(function () {

			// Transform span into link
			$('span.read-more').each(function (index) {
				$(this).wrap('<a href="#" class="togglebox-link"></a>');
			});

			// Add listeners
			$('.togglebox-link').click(function (e) {

				// first case: the text to be expanded is in the same paragraph.
				// second case: the text to be expanded is "below", i.e. sibling element.
				var $readMoreElement = $('.read-more-content', $(this).parent());
				if ($readMoreElement.length > 0) {
					$readMoreElement.toggle();
				} else {
					var $el;
					$el = $(this).parent().next();
					while ($el.length > 0) {

						// Stop loop when class "read-more" is found in sibling element which indicates,
						// there will be another toggable block below.
						if ($('.read-more', $el).length > 0) {
							$el = []; // will stop loop in while condition
						} else {
							// The class 'read-more-content' could be applied on the element itself.
							if ($($el).hasClass('read-more-content')) {
								$($el).toggle();
							} else {
								// Look into the content
								$('.read-more-content', $el).toggle();
							}
							$el = $el.next();
						}
					}
				}
				e.preventDefault();
			});
		});
	}); // end of closure
})(jQuery);
