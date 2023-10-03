<!--   Core JS Files   -->
<script src="{{ asset('Adminlinks/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('Adminlinks/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Adminlinks/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('Adminlinks/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('Adminlinks/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('Adminlinks/js/plugins/choices.min.js') }}"></script>
    <script src="{{ asset('Adminlinks/js/plugins/dropzone.min.js') }}"></script>
    <script src="{{ asset('Adminlinks/js/plugins/quill.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('Adminlinks/js/material-dashboard.min.js?v=3.1.0') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('status'))
        <script>
            Swal.fire({
                title: "{{ session('status') }}",
                icon: 'success' // Specify the 'success' icon
            });
        </script>
    @endif
</body>

</html>