<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>SIPS</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	@include('Layouts.styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>


</head>
<body>
	<div class="wrapper">
		{{-- navbar --}}
        @include('Layouts.Navbar')
        {{-- end navbar --}}
		<!-- Sidebar -->
        @include('Layouts.Sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
                @yield('content')
			</div>
            @include('Layouts.footer')
		</div>
	</div>
    @include('Layouts.scripts')
    @yield('script')

</body>
</html>
