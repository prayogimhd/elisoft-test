<!-- Modal -->
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ isset($data) ? 'Edit User' : 'Add User' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formUser">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" value="{{ isset($data) ? $data->id : '' }}" id="user_id"
                                    name="user_id">
                                <input type="text" id="name" value="{{ isset($data) ? $data->name : '' }}"
                                    name="name" class="form-control">
                                <div class="invalid-feedback errorname">
                                </div>
                            </div>
                        </div>
                        <label>Email</label>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="email" value="{{ isset($data) ? $data->email : '' }}"
                                    name="email" class="form-control">
                                <div class="invalid-feedback erroremail">
                                </div>
                            </div>
                        </div>
                        <label>Password</label>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="password" id="password"
                                    name="password" class="form-control">
                                <div class="invalid-feedback errorpassword">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-share-square"></i>
                        Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#formUser').submit(function(e) {
        e.preventDefault();
        $('#name').removeClass('is-invalid');
        $('#email').removeClass('is-invalid');
        let user_id = $('#user_id').val();
        let name = $('#name').val();
        let email = $('#email').val();
        let password = $('#password').val();
        $.ajax({
            type: "POST",
            url: 'actionUser',
            data: {
                user_id: user_id,
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: name,
                email: email,
                password: password,
            },
            dataType: 'json',
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
            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, function(index, value) {
                        $('.error' + index).text(value[0]);
                        $('#' + index).addClass('is-invalid');
                    });
                }
            }
        })
    })
</script>
