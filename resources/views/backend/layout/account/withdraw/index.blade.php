@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}
@section('title', 'Withdraw') {{-- setting the title of the page  --}}

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
                            <h4 class="card-title">Withdraw List</h4>
                        </div>
                    </div>


                    <div class="table-responsive mt-4 p-4">
                        <table class="table table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Account No</th>
                                    <th>Routing No</th>
                                    <th>Account No</th>
                                    <th>Bank Name</th>
                                    <th>Branch Name</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    {{-- <th>Created At</th> --}}
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

        // change auction status
        const auctionStatusHandler = (id, status) => {
            try {
                // console.log(id);
                let selected_state = $(status).val();
                // console.log(selected_state);
                $.ajax({
                    url: `{{ route('backend.account.withdraw.status.update') }}`,
                    method: 'PATCH',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        status: selected_state
                    },
                    success: function(response) {
                        console.log(response)
                        // Handle success if needed
                        console.log('User role updated successfully.');
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
                            url: "{{ route('backend.account.withdraw.index') }}",
                            type: "get",
                        },

                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'user_name',
                                name: 'user_name',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'account_number',
                                name: 'account_number',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'routing_number',
                                name: 'routing_number',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'account_name',
                                name: 'account_name',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'bank_name',
                                name: 'bank_name',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'branch_name',
                                name: 'branch_name',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'city',
                                name: 'city',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'state',
                                name: 'state',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'country',
                                name: 'country',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'amount',
                                name: 'amount',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'status',
                                name: 'status',
                                orderable: true,
                                searchable: true
                            },
                        ],
                    });

                    dTable.buttons().container().appendTo('#file_exports');

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
