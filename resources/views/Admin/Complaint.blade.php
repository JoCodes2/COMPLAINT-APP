@extends('Layouts.Base')
@section('title')
    Pengaduan
@endsection
@section('content')
    <div class="page-inner">
        <div class="page-header ">
            <h4 class="page-title"><i class="fas fa-list-alt pr-2"></i>Daftar Pengaduan</h4>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="loadData" class="display table table-striped table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Pengaduan</th>
                                        <th>Dari Nama/Instansi</th>
                                        <th>Tanggal Dan Waktu</th>
                                        <th>Kategori Pengaduan</th>
                                        <th>Deskripsi</th>
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
    </div>

    <div class="modal fade" id="detailPengaduanModal" role="dialog" aria-labelledby="detailPengaduanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl center" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="detailPengaduanModalLabel"><i class="fas fa-tasks pr-2"></i>Detail Pengaduan</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <table class="table table-hover text-nowrap">
                    <tr>
                        <td style="width: 50px"><strong>Nama Pengadu</strong></td>
                        <td style="width: 20px">:</td>
                        <td><span id="nameComplaint"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 50px"><strong>Asal Instansi</strong></td>
                        <td style="width: 20px">:</td>
                        <td><span id="agencyComplaint"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 50px"><strong>Nomor Pengaduan</strong></td>
                        <td style="width: 20px">:</td>
                        <td><span id="noComplaint"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 50px"><strong>Tanggal/Waktu Pengaduan</strong></td>
                        <td style="width: 20px">:</td>
                        <td><span id="createdAtComplaint"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 50px"><strong>Kategory Pengaduan</strong></td>
                        <td style="width: 20px">:</td>
                        <td><span id="categoryComplaint"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 50px"><strong>Status Pengaduan</strong></td>
                        <td style="width: 20px">:</td>
                        <td id="statusComplaint"></td>
                    </tr>
                    <tr>
                        <td style="width: 50px"><strong>Deskripsi Pengaduan</strong></td>
                        <td style="width: 20px">:</td>
                        <td><span id="descriptionComplaint"></span></td>
                    </tr>
                    <tr>
                        <td style="width: 50px"><strong>Gambar</strong></td>
                        <td style="width: 20px">:</td>
                        <td><span id="imageComplaint" class="img-fluid"></span></td>
                    </tr>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            return new Date(dateString).toLocaleString('id-ID', options);
        }
        function getData() {
            $.ajax({
                url: `/v1/complaint/`,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    let tableBody = "";
                    $.each(response.data, function(index, item) {
                        tableBody += "<tr>";
                            tableBody += "<td>" + (index + 1) + "</td>";
                            tableBody += "<td>" + item.no_complaint + "</td>";
                            tableBody += "<td class ='text-center'><strong class ='fw-bold fs-10'>" + item.user.name+ "</strong><br>" + item.user.agency + "</td>";
                            tableBody += "<td>" + formatDate(item.created_at) + "</td>";
                            tableBody += "<td>" + item.category_complaint.name_category + "</td>";
                            tableBody += "<td>" + item.description_complaint+ "</td>";
                            tableBody += "<td>";
                                tableBody += "<button type='button' class='btn btn-outline-primary btn-sm privies-detail' data-id='" + item.id + "'><i class='fas fa-eye pr-2'></i>Detail</button>";
                                tableBody += "<button type='button' class='btn btn-outline-success btn-sm approve' data-id='" + item.id + "'><i class='fas fa-check-square'></i></button>";
                                tableBody += "<button type='button' class='btn btn-outline-danger btn-sm reject' data-id='" + item.id + "'><i class='fas fa-times-circle'></i></button>";
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

        function getStatus(status_complaint) {
            let statusClass = '';
            let statusText = '';

            switch (status_complaint) {
                case 'not reviewed':
                    statusClass = 'btn btn-dark btn-sm btn-round';
                    statusText = 'Belum Ditinjau';
                    break;
                case 'reviewed':
                    statusClass = 'btn btn-success btn-sm btn-round';
                    statusText = 'Ditinjau';
                    break;
                default:
                    statusClass = 'btn btn-primary btn-sm btn-round';
                    statusText = '-';
            }

            return { statusClass, statusText };
        }

        $(document).on('click', '.privies-detail', function() {
            let complaintId = $(this).data('id');
            $.ajax({
                url: `/v1/complaint/get/${complaintId}`,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.code === 200) {
                        let complaint = response.data;
                        console.log(complaint);
                        $('#nameComplaint').text(complaint.user.name);
                        $('#agencyComplaint').text(complaint.user.agency);
                        $('#noComplaint').text(complaint.no_complaint);
                        $('#createdAtComplaint').text(formatDate(complaint.created_at));
                        $('#categoryComplaint').text(complaint.category_complaint.name_category);
                        $('#descriptionComplaint').text(complaint.description_complaint);
                        $('#statusComplaint').html('<span class="' + getStatus(complaint.status_complaint).statusClass + '">' + getStatus(complaint.status_complaint).statusText + '</span>');

                        $('#imageComplaint').html(complaint.image_complaint ? '<img src="uploads/file-pengaduan/' + complaint.image_complaint + '" alt="Complaint Image" class="img-fluid">' : 'Tidak ada gambar');

                        // Show the modal
                        $('#detailPengaduanModal').modal('show');
                    } else {
                        console.log('Error fetching complaint details');
                    }
                },
                error: function() {
                    console.log('Gagal mengambil detail pengaduan');
                }
            });
        });

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
