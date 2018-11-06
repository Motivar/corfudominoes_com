(function($) {
    "use strict";
    $(document).ready(function() {
        $(window).resize(function() {
            myresize();
        });

        /*Hide edit option from Bulk actions editor*/
        if (sbp_user_level.user == 'editor') {
            if ($('#bulk-action-selector-top option[value="edit"]').length > 0) {
                $('#bulk-action-selector-top option[value="edit"]').hide();
            }
        }

        if ($('.onlyone').length > 0) {
            $('.onlyone').on('click', function() {
                var idd = $(this).attr('id');
                if ($(this).is(":checked")) {
                    $('.onlyone').each(function() {
                        if ($(this).attr('id') != idd) {
                            $(this).attr('checked', false);
                        }
                    });
                }
            });
        }


    });

    function myresize() {

    }

})(jQuery);
