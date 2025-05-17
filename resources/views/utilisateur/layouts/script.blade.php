
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
   // Global delete confirmation with SweetAlert
   // Github buttons (existing)
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof GithubButtons !== 'undefined') {
            GithubButtons.init();
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#searshTable').DataTable({
            language: {
                search: "",
                searchPlaceholder: "{{ $placeholder ?? 'Rechercher...' }}"
            },
            dom: '<"d-flex justify-content-start align-items-center mb-3"f>t',
        });

        // Style and behavior for search input
        const $searchInput = $('.dataTables_filter input');
        
        $searchInput
            .addClass('form-control ps-3 shadow-sm custom-search')
            .css({
                'width': '400px',
                'border-radius': '12px',
                'transition': 'all 0.3s ease'
            });

        $('.dataTables_filter label').contents().filter(function() {
            return this.nodeType === 3;
        }).remove();
    });
</script>

<style> 
    
    .custom-search:focus {
        border-color: #0d3a73 !important;
        box-shadow: 0 0 5px rgba(13, 58, 115, 0.4);
    }
</style>

<script>
/**
 * Global delete confirmation
 * @param {number} id - Item ID
 * @param {HTMLElement} button - Clicked button
 * @param {string} [itemName] - Custom item name for confirmation text
 */
function confirmDelete(id, button, itemName = 'cet élément') {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: `Voulez-vous vraiment supprimer ${itemName} ? Cette action est irréversible !`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor:'#d33', 
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = button.closest('form');
            button.disabled = true;
            button.innerHTML = '<i class="material-symbols-rounded">hourglass_top</i>';
            form.submit();
        }
    });
}
</script>
<script>
document.getElementById('toggleSidebarBtn').addEventListener('click', function() {
  const sidebar = document.getElementById('sidenav-main');
  sidebar.classList.toggle('d-none'); // Hide/show sidebar
  
  // Toggle content width
  document.getElementById('main-content').classList.toggle('content-full-width');
});
</script>


<script>
    
</script>


