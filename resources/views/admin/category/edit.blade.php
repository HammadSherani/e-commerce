@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Category</h1>
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
		
		<form action="{{ route('admin.category.edit', $category->id)}}" method="POST" name="categoryForm" id="categoryForm">
			@csrf
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="name">Name</label>
								<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$category->name}}">
								<p></p>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="email">Slug</label>
								<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{$category->slug}}" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="status">Active</label>
								<select name="status" id="status" class="form-control">
									<option value="1" {{ ($category->status == 1) ? 'selected' : ''}}>Active</option>
									<option value="0" {{ ($category->status == 0) ? 'selected' : ''}}>Block </option>
								</select>
                                
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="pb-5 pt-3">
				<button class="btn btn-primary" type="submit">Update</button>
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
		e.preventDefault();
		var element = $(this) 
		$.ajax({
			url: "{{ route('admin.category.update', $category->id) }}",
			type: "put",
			data: element.serializeArray(),
			dataType: "json",
			success: function(res) {
				var error = res['errors'];
				if (res['status'] == true){
					window.location.href = "{{ route('admin.category.index') }}";
					$("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
					$("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
				} else {
					$("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
					$("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
				}
			},error: function(jqXHR, exception) {
				console.log("Something Went Wrong");
			}
		})
	})


	$("#name").change(function() {
		var element = $(this) 
		$.ajax({
			url: "{{ route('getSlug') }}",
			type: "get",
			data: {name: element.val()},
			dataType: "json",
			success: function(res) { 
			 if (res["status"] == true){
				$("#slug").val(res["slug"]);
			};
		}
		});
	})
</script>
@endsection