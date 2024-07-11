@extends('Layouts.Base')
@section('title')
    Penngguna
@endsection
@section('content')
    <div class="page-inner">
        <div class="page-header ">
            <h4 class="page-title"><i class="fas fa-list-alt pr-2"></i>Pengguna</h4>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary " id="myBtn">
                                <i class="fas fa-plus pr-2"></i>Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="loadData" class="display table table-striped table-hover" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Jabatan</th>
                                        <th>Nomor Telepon</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Instansi</th>
                                        <th>Level</th>
                                        <th>Password</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal --}}
        <div class="modal fade" id="upsertDataModal" role="dialog" aria-labelledby="upsertDataModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="upsertDataModalLabel"><i class="fas fa-tasks pr-2"></i>Form Data</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="upsertDataForm" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="nama anda">
                                        <small id="name-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control" name="nip" id="nip"
                                            placeholder="nip anda">
                                        <small id="nip-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Jabatan</label>
                                        <input type="text" class="form-control" name="position" id="position"
                                            placeholder="jabatan">
                                        <small id="position-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            placeholder="nomor telepon">
                                        <small id="phone-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="username">
                                        <small id="username-error" class="text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            placeholder="email@gmail.com">
                                        <small id="email-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="agency">Instansi</label>
                                        <input type="text" class="form-control" name="agency" id="agency"
                                            placeholder="instansi">
                                        <small id="agency-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Level</label>
                                        <select class="form-control" name="role" id="role">
                                            <option value="">Pilih Level</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                        <small id="role-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" id="passwordLabel">Password</label>
                                        <input type="password" class="form-control passwordLabel" name="password"
                                            id="password" placeholder="*******">
                                        <small id="password-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" id="passwordConfirmLabel">Konfirmasi
                                            Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation">
                                        <small id="password_confirmation-error" class="text-danger"></small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="simpanData">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#nip, #phone').on('input', function() {
            var input = $(this).val();
            if (!/^[0-9]*$/.test(input)) {
                $(this).val(input.slice(0, -1));
            }
        });

            function getData() {
                $.ajax({
                    url: `/v1/user`,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let tableBody = "";
                        $.each(response.data, function(index, item) {
                            tableBody += "<tr>";
                            tableBody += "<td>" + (index + 1) + "</td>";
                            tableBody += "<td>" + item.name + "</td>";
                            tableBody += "<td>" + item.nip + "</td>";
                            tableBody += "<td>" + item.position + "</td>";
                            tableBody += "<td>" + item.phone + "</td>";
                            tableBody += "<td>" + item.username + "</td>";
                            tableBody += "<td>" + item.email + "</td>";
                            tableBody += "<td>" + item.agency + "</td>";
                            tableBody += "<td>" + item.role + "</td>";
                            tableBody +=
                                "<td>****</td>"; // Menampilkan password yang disembunyikan
                             tableBody += "<td>";
                                tableBody += "<button type='button' class='btn btn-outline-primary btn-sm edit-btn' data-id='" + item.id + "'><i class='fas fa-edit'></i></button>";
                                tableBody += "<button type='button' class='btn btn-outline-danger btn-sm delete-confirm' data-id='" + item.id + "'><i class='fas fa-trash'></i></button>";
                            tableBody += "</td>";
                            tableBody += "</tr>";
                        });

                        $("#loadData tbody").html(tableBody);
                        $('#loadData').DataTable({
                            destroy: true,
                            paging: true,
                            searching: true,
                            ordering: true,
                            info: true,
                            order: []
                        });


                    },
                    error: function() {
                        console.log("Gagal mengambil data dari server");
                    }
                });
            }


            getData();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // messeage alert
            // alert success message
            function successAlert(message) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1000,
                })
            }

            // alert error message
            function errorAlert() {
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000,
                });
            }

            function reloadBrowsers() {
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }


            function confirmAlert(message, callback) {
                Swal.fire({
                    title: '<span style="font-size: 22px"> Konfirmasi!</span>',
                    html: message,
                    showCancelButton: true,
                    showConfirmButton: true,
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Ya',
                    reverseButtons: true,
                    confirmButtonColor: '#48ABF7',
                    cancelButtonColor: '#EFEFEF',
                    customClass: {
                        cancelButton: 'text-dark'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        callback();
                    }
                });
            }

            // loading alert
            function loadingAllert() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }

            // reset modal
            $('#upsertDataModal').on('hidden.bs.modal', function() {
                $('.text-danger').text('');
                $('#upsertDataForm')[0].reset();
                $('#id').val('');
            });
            // event click btn create
            $(document).on('click', '#myBtn', function() {
                $('.text-danger').text('');
                $('#upsertDataForm')[0].reset();
                $('#id').val('');
                $('#upsertDataModal').modal('show');
            })

            $(document).on('click', '#simpanData', function(e) {
                $('.text-danger').text('');
                e.preventDefault();

                let id = $('#id').val();
                let formData = new FormData($('#upsertDataForm')[0]);
                let url = id ? `/v1/user/update/${id}` : '/v1/user/create';
                let method = id ? 'POST' : 'POST';

                loadingAllert();

                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        Swal.close();
                        if (response.code === 422) {
                            let errors = response.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + '-error').text(value[0]);
                            });
                        } else if (response.code === 200) {
                            successAlert();
                            reloadBrowsers();
                        } else {
                            errorAlert();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.close();
                        errorAlert();
                    }
                });
            });

            // Edit data button click handler
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: `/v1/user/get/${id}`,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('#upsertDataModal').modal('show');
                        $('#id').val(response.data.id);
                        $('#name').val(response.data.name);
                        $('#nip').val(response.data.nip);
                        $('#position').val(response.data.position);
                        $('#phone').val(response.data.phone);
                        $('#username').val(response.data.username);
                        $('#email').val(response.data.email);
                        $('#agency').val(response.data.agency);
                        $('#role').val(response.data.role);
                        $('#password').val(response.data.password);
                        $('#passwordLabel').text('Masukan password baru')

                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data for edit:', error);
                    }
                });
            });



            // Delete data button click handler
            $(document).on('click', '.delete-confirm', function() {
                let id = $(this).data('id');

                // Function to delete data
                function deleteData() {
                    $.ajax({
                        type: 'DELETE',
                        url: `/v1/user/delete/${id}`,
                        success: function(response) {
                            if (response.code === 200) {
                                successAlert();
                                reloadBrowsers();
                            } else {
                                errorAlert();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

                // Show confirmation alert
                confirmAlert('Apakah Anda yakin ingin menghapus data?', deleteData);
            });



        });
    </script>
@endsection
