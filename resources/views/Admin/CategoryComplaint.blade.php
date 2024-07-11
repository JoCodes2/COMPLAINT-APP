@extends('Layouts.Base')
@section('title')
    Penduduk
@endsection
@section('content')
    <div class="page-inner">
        <div class="page-header ">
            <h4 class="page-title"><i class="fas fa-list-alt pr-2"></i>Kategori Pengaduan</h4>
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
                            <table id="loadData" class="display table table-striped table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Pengaduan</th>
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
        <div class="modal fade" id="upsertDataModal"  role="dialog" aria-labelledby="upsertDataModalLabel" aria-hidden="true">
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
                            <input type="hidden" name="id" id="id" >
                            <div class="form-group" >
                                <label for="name_category">Ketegory Pengaduan</label>
                                <input type="text"  class="form-control"  name="name_category" id="name_category" placeholder="input here...."></input>
                                <small id="name_category-error" class="text-danger"></small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="simpanData">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        function getData() {
            $.ajax({
                url: `/v1/category-complaint/`,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    let tableBody = "";
                    $.each(response.data, function(index, item) {
                        tableBody += "<tr>";
                            tableBody += "<td>" + (index + 1) + "</td>";
                            tableBody += "<td>" + item.name_category + "</td>";
                            tableBody += "<td>";
                                tableBody += "<button type='button' class='btn btn-outline-primary btn-sm edit-btn' data-id='" + item.id + "'><i class='fa fa-edit'></i></button>";
                                tableBody += "<button type='button' class='btn btn-outline-danger btn-sm delete-confirm' data-id='" + item.id + "'><i class='fa fa-trash'></i></button>";
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
        function loadingAllert(){
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
        $(document).on('click', '#myBtn' ,function(){
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
            let url = id ? `/v1/category-complaint/update/${id}` : '/v1/category-complaint/create';
            let method = id ? 'POST' : 'POST';

            loadingAllert();

            $.ajax({
                type: method,
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
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
                url: `/v1/category-complaint/get/${id}`,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    $('#upsertDataModal').modal('show');
                    $('#id').val(response.data.id);
                    $('#name_category').val(response.data.name_category);
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
                    url: `/v1/category-complaint/delete/${id}`,
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
