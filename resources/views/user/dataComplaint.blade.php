@extends('Layouts.userTemplete')
@section('content')
    <div class="container pt-5 mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="">
                <div class="card rounded-5">
                    <div class="card-body">
                        <div class="d-flex py-2">
                             <h1 class="font-kanit sky text-center" ><i class="fas fa-file-alt pr-5"></i> Pengaduan Anda
                            </h1>

                        </div>
                        <div class="table-responsive">
                            <table id="loadData" class="display table table-striped table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Pengaduan</th>
                                        <th>Tanggal Dan Waktu</th>
                                        <th>Kategori Pengaduan</th>
                                        <th>Deskripsi</th>
                                        <th>Status Pengaduan</th>
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
@endsection
@section('script')
<script>
    $(document).ready(function () {
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            return new Date(dateString).toLocaleString('id-ID', options);
        }

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
                            tableBody += "<td>" + formatDate(item.created_at) + "</td>";
                            tableBody += "<td>" + item.category_complaint.name_category + "</td>";
                            tableBody += "<td>" + item.description_complaint+ "</td>";
                            let status = getStatus(item.status_complaint);
                            tableBody += "<td class='text-center'><span class='" + status.statusClass + "'>" + status.statusText + "</span></td>";
                            tableBody += "<td>";
                                tableBody += "<button type='button' class='btn btn-outline-danger btn-sm delete-data' data-id='" + item.id + "'><i class='fas fa-trash'></i></button>";
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


        // funtion reload
        function reloadBrowsers() {
            setTimeout(function() {
                location.reload();
            }, 1500);
        }

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

        function confirmAlert(message, callback) {
            Swal.fire({
                title: '<span style="font-size: 22px"> Konfirmasi</span>',
                text: message,
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Ya',
                reverseButtons: true,
                confirmButtonColor: '#48ABF7',
                cancelButtonColor: '#EFEFEF',
                cancelButtonText: 'Tidak',
                customClass: {
                    cancelButton: 'text-dark'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            });
        }
        $(document).on('click', '.delete-data', function () {
            let id = $(this).data('id');

            // Function to delete data
            function deleteData() {
                $.ajax({
                    type: 'DELETE',
                    url: `/v1/complaint/delete/${id}`,
                    success: function (response) {
                        if (response.code === 200) {
                            successAlert();
                            reloadBrowsers();
                        }
                    },
                    error: function(xhr, status, error) {
                        errorAlert();
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
