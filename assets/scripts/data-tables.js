(function($) {
	
    $(document).ready(function() {

        if ($('.main-table-wrapper #main-table').length > 0) {

            $('#main-table').DataTable({
                searching: true,
                paging: true,
            });

        }

    });
	
})(jQuery);