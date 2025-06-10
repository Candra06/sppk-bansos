<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')
<body>
	<div class="wrapper">
		@include('admin.layout.navbar')

		<!-- Sidebar -->
		@include('admin.layout.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
                @yield('main')

			</div>
			@include('admin.layout.footer')
		</div>


	</div>
	@include('admin.layout.script')
</body>
</html>
