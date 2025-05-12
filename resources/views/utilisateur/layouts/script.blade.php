
<!-- Existing scripts -->
<script src="dist/assets/js/core/popper.min.js"></script>
<script src="dist/assets/js/core/bootstrap.min.js"></script>
<script src="dist/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="dist/assets/js/plugins/smooth-scrollbar.min.js"></script>

<!-- Add these new script dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Material Dashboard JS -->
<script src="dist/assets/js/material-dashboard.min.js?v=3.2.0"></script>

<!-- Your custom scripts -->
<script>
    // Initialize scrollbar (existing code)
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    // Initialize DataTables with Material Dashboard styling
    $(document).ready(function() {
        $('.datatable').each(function() {
            $(this).DataTable({
                language: {
                    search: "",
                    searchPlaceholder: "Rechercherdist.",
                    paginate: {
                        previous: '<i class="material-icons">chevron_left</i>',
                        next: '<i class="material-icons">chevron_right</i>'
                    },
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées"
                },
                dom: '<"row"<"col-sm-12 col-md-6"lf><"col-sm-12 col-md-6"p>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                initComplete: function() {
                    // Style the search input
                    $('.dataTables_filter input').addClass('form-control');
                    $('.dataTables_filter label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).remove();
                }
            });
        });
    });

    // Global delete confirmation with SweetAlert
    window.confirmDelete = function(formId, itemName = 'cet élément') {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous êtes sur le point de supprimer " + itemName + ". Cette action est irréversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn bg-gradient-danger me-2',
                cancelButton: 'btn bg-gradient-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    };

    // Github buttons (existing)
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof GithubButtons !== 'undefined') {
            GithubButtons.init();
        }
    });
</script>