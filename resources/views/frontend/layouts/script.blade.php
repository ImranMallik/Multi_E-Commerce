<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Add To Cart
        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                data: formData,
                url: "{{ route('add-to-cart') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(data) {
                    if (data.status === 'success') {
                        $('.mini-cart-action').removeClass('d-none');
                        getCount()
                        fetchSidebarcartProduct()
                        toastr.success(data.message);
                    } else if (data.status == 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {
                    toastr.error('An error occurred while adding the product to the cart.',
                        'Error', {
                            timeOut: 3000
                        });
                }

            });
        });

        // Cart Icon On Header Count
        function getCount() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.count') }}",
                success: function(data) {
                    $('#cart-count').text(data);
                },
                error: function(data) {
                    console.log('An error occurred while fetching the cart count.');
                }
            });
        }
        // Get Sidebar Cart Products
        function fetchSidebarcartProduct() {
            $.ajax({
                type: "GET",
                url: "{{ route('cart.sidebarProducts') }}",
                success: function(data) {
                    $('.mini_cart_wrapper').html(" ");
                    var html = '';
                    for (let item in data) {
                        let product = data[item];
                        html += `
                      <li id= "mini_cart_${product.rowId}">
                    <div class="wsus__cart_img">
                    <a href="{{ url('products-details') }}/${product.options.slug}"><img src="{{ asset('/  ') }}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                   <a class="wsis__del_icon remove_sidebar_product" data-id="${product.rowId}"   href="javascript:void(0);">
                  <i class="fas fa-minus-circle"></i>
                  </a>

              </div>
              <div class="wsus__cart_text">
                  <a class="wsus__cart_title" href="{{ url('products-details') }}/${product.options.slug}">${product.name}</a>
                  <p>{{ $settings->currency_icon }}${product.price}</p>
                   <small>Variants
                      total:{{ $settings->currency_icon }}${product.options.variants_total}</small>
                  <br>
                  <small>Qty:${product.qty}</small>
              </div>
          </li>`;
                    }

                    $('.mini_cart_wrapper').html(html);

                    getSitebarCartSubtotal();
                }
            })
        }

        // Remove product from sidebar cart

        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault();
            let rowId = $(this).data('id');
            // alert(rowId);

            $.ajax({
                method: 'POST',
                url: "{{ route('remove-cart-sidebar-products') }}",
                data: {
                    rowId: rowId
                },
                success: function(data) {
                    // console.log(data);
                    let productId = '#mini_cart_' + rowId;
                    $(productId).remove();
                    toastr.success('Product successfully removed');
                    if ($('.mini_cart_wrapper').find('li').length === 0) {
                        $('.mini-cart-action').addClass('d-none');
                        $('.mini_cart_wrapper').html(
                            '<div class="text-center"><i>Your Cart Is Empty!</i></div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                    console.log("Status: " + status);
                }
            });
        });

        function getSitebarCartSubtotal() {
            $.ajax({
                method: 'GET',
                url: "{{ route('total-cart-sidebar-products') }}",
                success: function(data) {
                    // console.log(data);
                    $('#mini_cart_subtotal').text("{{ $settings->currency_icon }}" + data)
                },
                error: function(data) {}
            });
        }



    });
</script>
