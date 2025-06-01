@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}
@section('title', 'Transaction') {{-- setting the title of the page  --}}

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
                            <h4 class="card-title">Transaction List</h4>
                        </div>
                    </div>


                    <div class="table-responsive mt-4 p-4">
                        <table class="table table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
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
    <script>

        $(document).ready(function() {
            // Showing data on the table
            try{
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
                            url: "{{ route('backend.account.transaction.index') }}",
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
                                data: 'transaction',
                                name: 'transaction',
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
                                data: 'payment_date',
                                name: 'payment_date',
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
            }catch (e) {
                console.log(e)
            }
        });
    </script>
@endpush
