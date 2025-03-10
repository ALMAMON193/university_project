@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/vendors/datatable/css/datatables.min.css') }}">
@endpush

@section('main-panel')
    <div class="row rounded" style="border: solid 1px gray; background: white;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Auction List</h4>
                        </div>

                        <div>
                            <a class="btn btn-primary" href="{{route('cms.car.page.faq.create')}}">Create FAQ</a>
                        </div>
                    </div>


                    <div class="table-responsive mt-4 p-4">
                        <table class="table table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('backend/vendors/datatable/js/datatables.min.js') }}"></script>
    {{-- sweet alart --}}
    <script src="{{ asset('backend/vendors/sweetalert/sweetalert2@11.js') }}"></script>

    <script>
        // sweet alert something went wrong
        const errorAlert = () => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        }

        // Sweet alert Delete confirm
        const deleteAlert = (id) => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteAuction(id);
                }
            });
        }


        // deleting an auction
        const deleteAuction = (id) => {
            try {
                let url = `{{ route('cms.car.page.faq.destory', ':id') }}`;
                let csrfToken = `{{ csrf_token() }}`;
                $.ajax({
                    type: "DELETE",
                    url: url.replace(':id', id),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: (response) => {
                        console.log(response);
                        // Reload DataTable
                        $('#data-table').DataTable().ajax.reload();
                        if (response.success === true) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Auction has been deleted.",
                                icon: "success"
                            });
                        } else if (response.errors) {
                            console.log(response.errors[0])
                            errorAlert()
                        } else {
                            console.log(response.message);
                            errorAlert()
                        }
                    },
                    error: (error) => {
                        console.log(error.message);
                        errorAlert()
                    }
                })
            } catch (e) {
                console.log(e)
            }
        }

        // change auction status
        const auctionStatusHandler = (id) => {
            try {
                $.ajax({
                    url: `{{ route('cms.car.page.faq.status') }}`,
                    method: 'PATCH',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id : id,
                    },
                    success: function(response) {
                        if (response.success === true) {
                            // show toast message
                            Swal.fire({
                                icon: "success",
                                title: "Status has been updated",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // Reload the page after the SweetAlert message is shown
                                window.location.reload();
                            });
                            var statusClassMap = {
                                '0': 'btn-danger',
                                '1': 'btn-success',
                            };
                            var newClass = 'btn btn-sm dropdown-toggle ' + statusClassMap[response.status];

                            // Remove existing status classes
                            $(statusElement).removeClass(
                                'btn-warning btn-success btn-danger btn-secondary');

                            // Add the new status class
                            $(statusElement).addClass(newClass);
                            console.log(response.message);

                        } else if (response.errors) {
                            console.log(response.errors[0]);
                            errorAlert()
                        } else {
                            console.log(response.message);
                            errorAlert()
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error if needed
                        console.error('Error updating user role:', error);
                        errorAlert()
                    }
                })
            } catch (e) {
                console.log(e)
            }

        }

        // change auction featured

        const auctionFeaturedHandler = (id, featured) => {
            try {
                // console.log(id);
                let selected_state = $(featured).val();
                console.log(selected_state);
                $.ajax({
                    url: `{{ route('backend.auction.featured.update') }}`,
                    method: 'PATCH',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        featured: selected_state
                    },
                    success: function(response) {
                        // Handle success if needed
                        console.log('User role updated successfully.');
                        if (response.success === true) {
                            // show toast message
                            Swal.fire({
                                icon: "success",
                                title: "Featured has been updated",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            console.log(response.message);

                        } else if (response.errors) {
                            console.log(response.errors[0]);
                            errorAlert()
                        } else {
                            console.log(response.message);
                            errorAlert()
                        }
                    },
                    error: function(xhr, featured, error) {
                        // Handle error if needed
                        console.error('Error updating user role:', error);
                        errorAlert()
                    }
                })
            } catch (e) {
                console.log(e)
            }

        }



        $(document).ready(function() {
            // Showing data on the table
            try {
                if (!$.fn.DataTable.isDataTable('#data-table')) {
                    let dTable = $('#data-table').DataTable({
                        order: [],
                        lengthMenu: [
                            [25, 50, 100, 200, 500, -1],
                            [25, 50, 100, 200, 500, "All"]
                        ],
                        processing: true,
                        responsive: true,
                        serverSide: true,

                        language: {
                            processing: `<div class="text-center">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                        </div>`
                        },

                        scroller: {
                            loadingIndicator: false
                        },
                        pagingType: "full_numbers",
                        dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                        ajax: {
                            url: "{{ route('cms.car.page.faq.index') }}",
                            type: "get",
                        },

                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'question',
                                name: 'question',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'status',
                                name: 'status',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ],
                    });
                    new DataTable('#example', {
                        responsive: true
                    });
                }
            } catch (e) {
                console.log(e)
            }
        });
    </script>
@endpush
