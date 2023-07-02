@extends('frontend.layouts.master')
@section('content')
    
    <div class="container-fluid mt-3">
        <h3>Home Page</h3>
        
    </div>
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($products as $item)
                <div class="col">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%"
                                fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>

                        <div class="card-body">
                            <p class="card-text">{{ $item->name }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary add-to-card"
                                        data-id="{{ $item->id }}">Add To Card</button>
                                    {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                                </div>
                                <small class="text-muted">$ {{$item->price}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="row m-2">
            <ul class="pagination">
                {{ $products->links() }}

            </ul>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.add-to-card').on('click', function() {
                debugger;
                var product_id = $(this).data('id');
                if (product_id) {
                    var url1 = "{{ route('addtocart_direct', ['idl1']) }}";
                    url1 = url1.replace('idl1', product_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        data: {
                            id: product_id,
                        },
                        url: url1,
                        success: function(data) {
                          
                            if (data.status==200) {
                                alert(data.message);
                            } else {
                                alert(data.message);
                                $("#loginModalHeader").modal("show");
                            }
                        },
                      
                    })
                }

            })
        });

        function addToCartDirect(id, event) {
            event.preventDefault();
            var url1 = "{{ route('addtocart_direct', ['idl1']) }}"
            if (!id) {
                var id = $("#product_id").val();
            }
            console.log(id);
            url1 = url1.replace('idl1', id);
            console.log(url1);
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    id: id,
                },
                url: url1,
                success: function(data) {
                    miniCart(event);

                    // $('#closeModal').click();

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if (data.status) {
                        Toast.fire({
                            type: 'success',
                            title: data.message
                        });
                    } else {
                        const Toast_error = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        Toast_error.fire({
                            type: 'danger',
                            title: data.message
                        });
                        $("#login_modal").modal("show");
                    }
                },
            })
        }
    </script>
@endsection
