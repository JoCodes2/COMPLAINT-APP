@extends('Layouts.Base')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><i class="fas fa-list-alt pr-2"></i>Dashboard</h4>
        </div>

        <!-- Card Section -->
        <div class="row">
            <!-- Card Total -->
            <div class="col-sm-4">
                <div class="card text-white mb-3 card-hover" id="totalcomplain" style="background-color: #0d47a1;">
                    <div class="card-body">
                        <h5 class="card-title">Total</h5>
                        <p class="card-text">Jumlah total data</p>
                        <h3 class="card-text" id="total-complaint">123</h3> <!-- Ganti dengan data dinamis jika diperlukan -->
                    </div>
                </div>
            </div>

            <!-- Card Total Ditinjau -->
            <div class="col-sm-4">
                <div class="card text-white mb-3 card-hover" id="totaltinjau" style="background-color: #2196f3;">
                    <div class="card-body">
                        <h5 class="card-title">Total Ditinjau</h5>
                        <p class="card-text">Jumlah data yang sudah ditinjau</p>
                        <h3 class="card-text" id="total-reviewed">45</h3> <!-- Ganti dengan data dinamis jika diperlukan -->
                    </div>
                </div>
            </div>

            <!-- Card Total Belum Ditinjau -->
            <div class="col-sm-4">
                <div class="card text-white mb-3 card-hover" id="totalbelumtinjau" style="background-color: #64b5f6;">
                    <div class="card-body">
                        <h5 class="card-title">Total Belum Ditinjau</h5>
                        <p class="card-text">Jumlah data yang belum ditinjau</p>
                        <h3 class="card-text" id="total-not-reviewed">78</h3> <!-- Ganti dengan data dinamis jika diperlukan -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Card Section -->
    </div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/complaints', // Ganti dengan endpoint yang benar
            method: 'GET',
            success: function(response) {
                $('#total-complaint').text(response.total_complaint);
                $('#total-reviewed').text(response.total_reviewed);
                $('#total-not-reviewed').text(response.total_not_reviewed);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    });
</script>
@endsection
