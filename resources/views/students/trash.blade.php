@extends('layouts.main')
@section('title', 'Majors')

@section('page_title', 'Majors')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">@yield('page_title')</li>
@endsection

@section('content')

    {{-- <h1> WELCOME</h1> --}}
    <div class="mt-3"></div>
    <div class="row mb-2">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                Create New Student
            </button>
        </div>
    </div>



    <div class="card">
        <div class="card-body table-responsive">
            <table id="dataTable" class="table table-bordered text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Bp</th>
                        <th>Majors</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>status</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">


                <form action="#" class="form-create" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create New Majors</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> No Bp </label>
                            <input type="text" name="no_bp" class="form-control" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label> Majors </label>
                            <select name="id_majors" class="form-control" placeholder="Select Accreditation">
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Gender </label>
                            <select name="gender" class="form-control" placeholder="Select Accreditation">
                                <option value="male">Male</option>
                                <option value="female">Female</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label> Status </label>
                            <select name="status" class="form-control" placeholder="Select Accreditation">
                                <option value="graduated">GRADUATED</option>
                                <option value="collage leave">collage leave</option>
                                <option value="active">active</option>
                                <option value="inactive/drop out">inactive/drop out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Adddress </label>
                            <textarea type="text" name="address" class="form-control" placeholder="Enter Title" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>

        </div>

    </div>
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">


                <form action="#" class="form-update" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> No Bp </label>
                            <input type="text" name="no_bp" class="form-control" placeholder="Enter Title" required>
                            <input type="hidden" name="id">
                        </div>
                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Title"
                                required>
                        </div>
                        <div class="form-group">
                            <label> Majors </label>
                            <select name="id_majors" class="form-control" placeholder="Select Accreditation">
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Gender </label>
                            <select name="gender" class="form-control" placeholder="Select Accreditation">
                                <option value="male">Male</option>
                                <option value="female">Female</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label> Status </label>
                            <select name="status" class="form-control" placeholder="Select Accreditation">
                                <option value="graduated">GRADUATED</option>
                                <option value="collage leave">collage leave</option>
                                <option value="active">active</option>
                                <option value="inactive/drop out">inactive/drop out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Adddress </label>
                            <textarea type="text" name="address" class="form-control" placeholder="Enter Title" required></textarea>
                        </div>


                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('custom-script')
    <script>
        $(function() {
            loadData();

        });

        function loadData() {
            $.ajax({
                url: "/trash/student/getDataRestore",
                type: "GET",
                data: {}
            }).done(function(result) {
                $('#dataTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "destroy": true,
                    "responsive": true,
                    "data": result.data,
                    "columns": [{
                        "data": "no"
                    }, {
                        "data": "no_bp"
                    }, {
                        "data": "major.name"
                    }, {
                        "data": "name"
                    }, {
                        "data": "gender"
                    }, {
                        "data": "status"
                    }, {
                        "data": "address"
                    }, {
                        "data": "id"
                    }],
                    "columnDefs": [{
                        "targets": 7,
                        "data": "id",
                        "render": function(data, type, row) {
                            return '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default">Action</button>' +
                                '<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">' +
                                '<span class="sr-only">Toggle Dropdown</span>' +
                                '</button>' +
                                '<div class="dropdown-menu" role="menu">' +
                                '<a class="dropdown-item btn-force" data-id="' + row.id +
                                '" href="#">Delete Permanen</a>' +


                                '<input type="submit" class="dropdown-item btn-delete" data-id="' +
                                row.id + '" value="Restore Student" href="#">' +


                                '</div></div>';
                        }
                    }, ]
                })
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        }

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault()

            if (confirm("Are you sure to Restore data?")) {
                var inputToken = $("input[name=_token]")

                $.ajax({
                    url: "/trash/student/restoreData/" + $(this).data('id'),
                    type: "POST",
                    data: {
                        _token: inputToken.val()
                    }
                }).done(function(result) {
                    inputToken.val(result.newToken)
                    if (result.status) {
                        loadData()
                        alert(result.message)

                    } else {
                        alert(result.message)
                    }
                }).fail(function(xhr, error) {
                    console.log('xhr', xhr.status)
                    console.log('error', error)
                })
            }


        })
        $(document).on('click', '.btn-force', function(e) {
            e.preventDefault()

            if (confirm("Are you sure to Delete Permanent data?")) {
                var inputToken = $("input[name=_token]")

                $.ajax({
                    url: "/trash/student/forch/" + $(this).data('id'),
                    type: "POST",
                    data: {
                        _token: inputToken.val()
                    }
                }).done(function(result) {
                    inputToken.val(result.newToken)
                    if (result.status) {
                        loadData()
                        alert(result.message)

                    } else {
                        alert(result.message)
                    }
                }).fail(function(xhr, error) {
                    console.log('xhr', xhr.status)
                    console.log('error', error)
                })
            }


        })
    </script>
@endpush
