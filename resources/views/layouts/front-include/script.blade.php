<!--   Core JS Files   -->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('status'))
<script>
    Swal.fire({
        title: "{{ session('status') }}",
        icon: 'success' // Specify the 'success' icon
    });
</script>
@endif
@if (session('message'))
<script>
    Swal.fire({
        title: "{{ session('message') }}",
        icon: 'error' // Specify the 'error' icon
    });
</script>
@endif
</body>
<script>
    $('.feature-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })

    $(document).ready(function () {
        var description = $("#description");
        var readMoreBtn = $("#read-more-btn");
        var readLessBtn = $("#read-less-btn");

        // Split the description into paragraphs based on line breaks
        var paragraphs = description.html().split('\n');

        // Remove empty paragraphs (if any)
        paragraphs = paragraphs.filter(function (paragraph) {
            return paragraph.trim() !== '';
        });

        // Check if there are more than one paragraph
        if (paragraphs.length > 1) {
            description.html(paragraphs[0]); // Show only the first paragraph
            // Show the "Read More" button
            readMoreBtn.removeClass('d-none');
            readMoreBtn.show();

            readMoreBtn.click(function () {
                // Show all paragraphs and hide "Read More"
                description.html(paragraphs.join('')); // Rejoin paragraphs with <br> tags
                readMoreBtn.addClass('d-none');
                readMoreBtn.hide();
                readLessBtn.removeClass('d-none');
                readLessBtn.show();
            });

            readLessBtn.click(function () {
                // Hide additional paragraphs and show "Read More"
                description.html(paragraphs[0]); // Show only the first paragraph
                readMoreBtn.removeClass('d-none');
                readMoreBtn.show();
                readLessBtn.addClass('d-none');
                readLessBtn.hide();
            });
        } else {
            // If only one paragraph, hide the buttons
            readMoreBtn.hide();
            readLessBtn.hide();
        }
        
       // Increment button click handler
       $('.increment').click(function (e) {
            e.preventDefault();
            var input = $(this).closest('.input-group').find('.qty-input');
            var value = parseInt(input.val(), 10);
            value = isNaN(value) ? 0 : value;
            if (value < 10) {
                value++;
                input.val(value);
            }
        });

        // Decrement button click handler
        $('.decrement').click(function (e) {
            e.preventDefault();
            var input = $(this).closest('.input-group').find('.qty-input');
            var value = parseInt(input.val(), 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                input.val(value);
            }
        });
        
        // addToCartBtn button click handler
        $('.addToCartBtn').click(function (e) {
            e.preventDefault();

            // Get product ID and quantity
            var product_id = $(this).closest('.row').find('.product_id').val();
            var quantity = $(this).closest('.row').find('.qty-input').val();
            // You can send the product ID and quantity to your server using AJAX
            // Here's a basic example of sending data to a URL
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/add-to-cart', // Replace with your server-side route
                data: {
                    product_id: product_id,
                    quantity: quantity,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    // Handle the success response (e.g., display a message)
                    Swal.fire({
                        title: response.status,
                    });
                },
                error: function (error) {
                // Handle any errors
                Swal.fire({
                    title: "Please log in to add products to the cart.",
                    showCancelButton: true, // Show the Cancel button
                    confirmButtonText: 'OK', // Change the OK button text
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect the user to the login page
                        window.location.href = "/login";
                    }
                });
            }
            });
        });
    });
</script>

</html>