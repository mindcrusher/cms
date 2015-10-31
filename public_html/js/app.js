jQuery(function(){

    $('#menu button').click(function(){
        $( "#menu .collapsible-area" ).toggle('fast');
    });

    jQuery(document).on('click', '.showModalButton', function(){
        if (jQuery('#pending-form').data('bs.modal').isShown) {
            jQuery('#pending-form').find('#modalContent')
                .load($(this).attr('href'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            jQuery('#pending-form').modal('show')
                .find('#modalContent')
                .load($(this).attr('href'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
    });