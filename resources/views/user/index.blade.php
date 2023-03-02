@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="viewmodal"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <a href="javascript:void(0)" id="addUser" class="btn btn-primary"> <i
                                        class="fa fa-plus"> Add User</i> </a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="listUser" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <script>
        $(function() {
            $('#listUser').DataTable({
                processing: true,
                serverSide: true,
                ajax: "user",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });

        $('body').on('click', '#addUser', function() {
            $.ajax({
                type: "post",
                url: "formUser",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('.viewmodal').html(response.success).show();
                        $('#modalUser').modal('show');
                    }
                }
            });
        })

        $('body').on('click', '#editUser', function() {
            let user_id = $(this).data('user');
            $.ajax({
                type: "post",
                url: "formUser",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    user_id: user_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('.viewmodal').html(response.success).show();
                        $('#modalUser').modal('show');
                    }
                }
            });
        })

        $('body').on('click', '#deleteUser', function() {
            let user_id = $(this).data('user');
            $.ajax({
                type: "post",
                url: "deleteUser/" + user_id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    user_id: user_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        swal(response.message, {
                            icon: "success",
                        }).then((success) => {
                            $('#modalUser').modal('hide');
                            $('#listUser').DataTable().ajax.reload();
                        });
                    } else {
                        swal(response.message, {
                            icon: "warning",
                        });
                    }
                }
            });
        })
    </script>
@endsection
