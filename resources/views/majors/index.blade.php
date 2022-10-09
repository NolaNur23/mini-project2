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
                Create Data News
            </button>
        </div>
    </div>



    <div class="card">
        <div class="card-body table-responsive">
            <table id="dataTable" class="table table-bordered text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>name</th>
                        <th>Accreditation</th>
                        <th>Created At</th>
                        {{-- <th>Updated At</th> --}}
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
                            <label> Name </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label> Accreditation </label>
                            <select name="accreditation" class="form-control" placeholder="Select Accreditation">
                                <option value="unaccredited">Unaccredited</option>
                                <option value="good">Good</option>
                                <option value="excellent">Excellent</option>
                                <option value="superior">Superior</option>
                            </select>
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
                        <h5 class="modal-title" id="exampleModalLabel">Update Major </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Title </label>
                            <input type="text" name="name" class="form-control" required>
                            <input type="text" name="id" class="form-control" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label> Accreditation </label>
                            <select name="accreditation" class="form-control" placeholder="Select Accreditation">
                                <option value="unaccredited">Unaccredited</option>
                                <option value="good">Good</option>
                                <option value="excellent">Excellent</option>
                                <option value="superior">Superior</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label> Description</label>
                            <textarea name="description" rows="3" class="form-control" placeholder="Enter Description" required></textarea>
                        </div> --}}
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
                url: "/major/getData",
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
                        "data": "name"
                    }, {
                        "data": "accreditation"
                    }, {
                        "data": "created_at"
                    }, {
                        "data": "id"
                    }],
                    "columnDefs": [{
                            "targets": 4,
                            "data": "id",
                            "render": function(data, type, row) {
                                return '<div class="btn-group">' +
                                    '<button type="button" class="btn btn-default">Action</button>' +
                                    '<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">' +
                                    '<span class="sr-only">Toggle Dropdown</span>' +
                                    '</button>' +
                                    '<div class="dropdown-menu" role="menu">' +
                                    '<a class="dropdown-item btn-edit" data-id="' + row.id +
                                    '" href="#">Edit</a>' +


                                    '<input type="submit" class="dropdown-item btn-delete" data-id="' +
                                    row.id + '" value="Delete" href="#">' +


                                    '</div></div>';
                            }
                        },


                        //tempat mengubah warna, button dll

                    ]
                })
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        }
        $(document).on('submit', '.form-create', function(e) {

            e.preventDefault()
            var form = $(this)
            var inputToken = form.find("input[name=_token]")
            var name = form.find("input[name=name]")
            // var descrip = form.find("textarea[name=description]")
            var accreditation = form.find("select[name=accreditation]")
            $.ajax({
                url: "/major/createData",
                type: "POST",
                data: {
                    _token: inputToken.val(),
                    // title: title.val(),
                    name: name.val(),
                    accreditation: accreditation.val()

                }
            }).done(function(result) {
                inputToken.val(result.newToken)
                if (result.status) {
                    $('#modalCreate').modal('hide'),
                        alert(result.message)
                    loadData()
                } else {
                    alert(result.message)
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
                loadData()
            })
        })

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            var form = $(this)
            window.onload = () => {
                $('#onload').modal('show');
            }

            $.ajax({
                url: "/major/getData",
                Type: "POST",
                data: {
                    id: $(this).data('id'),

                }
            }).done(function(result) {
                if (result.data) {
                    var form = $('.form-update')
                    var data = result.data
                    form.find('input[name=name]').val(data.name)
                    // form.find('textarea[name=description]').val(data.description)
                    form.find('select[name=accreditation]').val(data.accreditation)
                    form.find('input[name=id]').val(data.id)

                    $('#modalUpdate').modal('show')
                } else {
                    alert('data not found')
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        })
        $(document).on('submit', '.form-update', function(e) {
            // java script
            e.preventDefault()
            var form = $(this)
            var inputToken = form.find("input[name=_token]")
            $.ajax({
                url: "/major/updateData/" + form.find("input[name=id]").val(),
                type: "POST",
                data: {
                    // name=form(*didefinisikan var diatas, mengambilkan form this). temukan("input merupakan type[name=name]").ambil
                    _token: inputToken.val(),
                    name: form.find("input[name=name]").val(),
                    // description: form.find("textarea[name=description]").val(),
                    accreditation: form.find("select[name=accreditation]").val(),

                }
            }).done(function(result) {
                inputToken.val(result.newToken)
                if (result.status) {
                    $('#modalUpdate').modal('hide'),
                        alert(result.message)
                    loadData()
                } else {
                    alert(result.message)
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
                loadData()
            })

        })
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault()

            if (confirm("Are you sure to delete Major?")) {
                var inputToken = $("input[name=_token]")

                $.ajax({
                    url: "/major/deleteData/" + $(this).data('id'),
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
