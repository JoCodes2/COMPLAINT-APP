@extends('Layouts.userTemplete')
@section('content')
    <section class="home" id="home">
      <div class="container pt-5 mt-5" data-aos="zoom-in">
        <div class="row pt-2 justify-content-center">
          <div class="col-md-5 d-flex justify-content-center align-items-center">
            <div class="bg-home ">
              <img src="{{ asset('Image/home2.png') }}" class="img-fluid img" alt="">
            </div>
          </div>
          <div class="col-md-5 d-flex flex-column justify-content-center align-items-start">
            <p class="text-hai font-popins">Hallo 👋
                <span class="sky px-2">
                   Administrator
                </span>
            </p>
            <h1 class="title-home font-kanit sky">Selamat Datang di Sistem Informasi Pengaduan Aplikasi SRIKANDI
            </h1>
            <p class="intro-junior font-popins ">
                Aplikasi ini dibuat untuk melaporkan pengaduan tentang kekurangan atau kendala dalam menggunakan aplikasi SRIKANDI,
                 yang dimana aplikasi SRIKANDI sampai saat ini masih dalam proses pengembangan
            </p>
            {{-- <div class="row text-center">
                <div class="col-md-4">
                    <div class="card rounded-5">
                        <div class="card-body">
                            <h6 class="header-dashboard">Total Permohonan Anda</h6>
                            <h3 class="card-subtitle  text-muted fw-bold" id="totalRequest"></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card rounded-5">
                        <div class="card-body">
                            <h6 class="header-dashboard">Permohonan Dalam Antrian</h6>
                            <h3 class="card-subtitle  text-muted fw-bold" id="totalPending"></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card rounded-5">
                        <div class="card-body">
                            <h6 class="header-dashboard">Total Permohonan Diterima</h6>
                            <h3 class="card-subtitle  text-muted fw-bold" id="totalApprove"></h3>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
      </div>
    </section>
    <section class="form-pengajuan">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-10">
                    <div class="row d-flex justify-content-center align-items-center py-2">
                        <h1 class="font-kanit sky text-center" data-aos="zoom-in">Silahkan mengisi Form dibawah untuk menjelaskan kendala saat menggunakan Aplikasi SRIKANDI
                        </h1>
                    </div>
                    <div class="card rounded-5" data-aos="zoom-in">
                        <div class="card-header">
                            <h2 class="font-kanit sky " id="pendudukModalLabel"><i class="fas fa-file-alt pr-5 pr-2"></i>Form Pengaduan</h2>
                        </div>
                        <div class="card-body">
                            <form id="upsertData" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="id_user">Nama </label>
                                            <select name="id_user" id="id_user" class="form-control">
                                                <option value="" selected disabled>--pilih--</option>
                                            </select>
                                            <small id="id_user-error" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_category_complaint">Kategori Pengaduan</label>
                                            <select name="id_category_complaint" id="id_category_complaint" class="form-control">
                                                <option value="" selected disabled>--pilih--</option>
                                            </select>
                                            <small id="id_category_complaint-error" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="description_complaint">Deskripsi Pengaduan</label>
                                            <textarea class="form-control"name="description_complaint" id="description_complaint" style="display: none;"></textarea>
                                            <div id="summernote"></div>
                                            <small id="description_complaint-error" class="text-danger"></small>
                                        </div>
                                        <div class="form-group fill">
                                            <label for="image_complaint">Upload File (Jika Ada)</label>
                                            <input type="file" class="form-control" name="image_complaint" id="image_complaint" >
                                            <span id="image_complaint_filename" class="text-muted"></span>
                                            <small id="image_complaint-error" class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                         <div class="card-footer d-flex justify-content-end">
                            <button type="button" class="btn-cencel rounded-5 mr-2 px-3 py-1" id="btnBatal">Batal</button>
                            <button type="button" class="btn-home px-3 py-1 font-popins rounded-5" id="btnSimpan">Kirim Pengaduan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
$(document).ready(function () {

$('#summernote').summernote({
        tabsize: 2,
        height: 180,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        placeholder: 'Silahkan isi detail pengaduan anda disini',
        callbacks: {
            onChange: function(contents, $editable) {
                $('#description_complaint').val(contents);
            }
        }
    });

     // Function to populate user dropdown
    function populateUserDropdown() {
        $.ajax({
            url: 'v1/user',
            method: 'GET',
            success: function(response) {
                $('#id_user').empty().append('<option value="" selected disabled>--pilih--</option>');
                $.each(response.data, function(key, value) {
                    $('#id_user').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
        });
    }

    // Function to populate category complaint dropdown
    function populateCategoryComplaintDropdown() {
        $.ajax({
            url: 'v1/category-complaint/',
            method: 'GET',
            success: function(response) {
                $('#id_category_complaint').empty().append('<option value="" selected disabled>--pilih--</option>');
                $.each(response.data, function(key, value) {
                    $('#id_category_complaint').append('<option value="' + value.id + '">' + value.name_category + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
        });
    }

    // Call the functions to populate dropdowns
    populateUserDropdown();
    populateCategoryComplaintDropdown();


    $('#btnBatal').click(function() {
        $('#upsertData')[0].reset();
        $('#summernote').summernote('code', placeholderContent);
        $('#id_category_complaint').val('');
        $('#id_user').val('');
        $('#description_complaint').val('');
    });

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
    $(document).on('click', '#btnSimpan', function(e) {
        $('.text-danger').text('');
        e.preventDefault();

        let id = $('#id').val();
        let formData = new FormData($('#upsertData')[0]);
        loadingAllert();

        $.ajax({
            type: 'POST',
            url: '/v1/complaint/create',
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
});
</script>
@endsection
