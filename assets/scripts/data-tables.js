(function($) {
	
    $(document).ready(function() {

        if ($('.main-table-wrapper #main-table').length > 0) {

            var mainTable = $('#main-table').DataTable({
                searching: true,
                paging: true,
                pageLength: 15,
                responsive: true,
                autoWidth: true,
                language: {
                    "sProcessing":     "Traitement en cours...",
                    "sSearch":         "Rechercher&nbsp;:",
                    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                    "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix":    "",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                    "oPaginate": {
                        "sFirst":      "Premier",
                        "sPrevious":   "Pr&eacute;c&eacute;dent",
                        "sNext":       "Suivant",
                        "sLast":       "Dernier"
                    },
                    "oAria": {
                        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                    }
                }
            });

            $('#main-table tfoot td').each( function () {
            var title = $(this).text();
                $(this).html('<input type="text" placeholder="' + title + '" />');
            } );

            mainTable.columns().every( function () {
                var that = this;
        
                $('input', this.footer() ).on('keyup change', function () {

                    if (that.search() !== this.value) {
                        that
                            .search( this.value )
                            .draw();
                    }

                } );

            } );

        }

    });
	
})(jQuery);