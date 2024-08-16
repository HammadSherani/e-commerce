@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Create Category</h1>
			</div>
			<div class="col-sm-6 text-right">
				<a href="{{ route('admin.category.index')}}" class="btn btn-primary">Back</a>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="container-fluid">
		<form action="{{ route('admin.category.store')}}" method="POST" name="categoryForm" id="categoryForm">
			@csrf

			
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="name">Name</label>
								<input type="text" name="name" id="name" class="form-control" placeholder="Name">
								<p></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="email">Slug</label>
								<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="status">Active</label>
								<select name="status" id="status" class="form-control">
									<option value="1">Active</option>
									<option value="0">Block</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="pb-5 pt-3">
				<button class="btn btn-primary" type="submit">Create</button>
				<a href="{{ route('admin.brands')}}" class="btn btn-outline-dark ml-3">Cancel</a>
			</div>
		
		</form>

		@foreach ($errors->all('<p>:message</p>') as $input_error)
			{{ $input_error }}
			@endforeach
	</div>
	<!-- /.card -->
</section>
<!-- /.content -->

@endsection


@section('customJs')
<script>
	$("#categoryForm").submit(function(e) {
		// e.preventDefault();
		// $data = $(this).serialize();
		var element = $(this) 
		$.ajax({
			url: "{{ route('admin.category.store') }}",
			type: "POST",
			data: element.serializeArray(),
			dataType: "json",
			success: function(res) {
				var error = res['errors']
				if (error['name']){
					$("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
				}else {
					$("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
				}

				if (error['slug']){
					$("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
				}else {
					$("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
				}
			},error: function(jqXHR, exception) {
				console.log("Something Went Wrong");
			}
		})
	})
</script>
@endsection