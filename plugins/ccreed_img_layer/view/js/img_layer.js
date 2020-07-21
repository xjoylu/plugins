// modify img tag to what the lightbox need
$(function() {
    $('.message img').each(function(i) {
        if (this.parentNode.href == false) {
            $(this).wrap("<a href='" + this.src + "' data-toggle='lightbox' data-gallery='entry-gallery'></a>");
         } else {
             $(this).parent().attr({'href':this.src, 'data-toggle': 'lightbox', 'data-gallery':'entry-gallery'});
        }
    });
});


$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    return $(this).ekkoLightbox({
        onShown: function() {
            if (window.console) {
                return console.log('Checking our the events huh?');
            }
        },
        onNavigate: function(direction, itemIndex) {
            if (window.console) {
                return console.log('Navigating ' + direction + '. Current item: ' + itemIndex);
            }
        }
    })
});