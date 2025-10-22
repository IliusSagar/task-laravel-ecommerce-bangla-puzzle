@extends('master.backend')

@section('content')


<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1><span class="text-danger" style="border-bottom: 1px dotted red;">Edit Product</span></h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <!-- <h3 class="card-title">Edit Logo</h3> -->
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                <div class="form-group">
                                    <label class="custom-label">Category Name <code>*</code></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    <span style="color: red;">
                                        @error('category_id') {{ $message }} @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label class="custom-label">Sub Category Name <code>*</code></label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                        <option value="">Select Subcategory</option>
                                        @foreach($subcategories as $sub)
                                        <option value="{{ $sub->id }}" {{ $product->sub_category_id == $sub->id ? 'selected' : '' }}>
                                            {{ $sub->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    <span style="color: red;">
                                        @error('sub_category_id') {{ $message }} @enderror
                                    </span>
                                </div>



                                <div class="form-group">
                                    <label class="custom-label">Product Name <code>*</code></label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">

                                    <span style="color: red;">
                                        @error('name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label class="custom-label">Description <code>(optional)</code></label>
                                    <textarea name="description" id="description" class="form-control summernote">{{ old('description', $product->description ?? '') }}</textarea>

                                    <span style="color: red;">
                                        @error('description')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label class="custom-label">Old Price <code>*</code></label>
                                    <input type="text" name="old_price" class="form-control" value="{{ $product->old_price }}">

                                    <span style="color: red;">
                                        @error('old_price')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label class="custom-label">New Price <code>*</code></label>
                                    <input type="text" name="new_price" class="form-control" value="{{ $product->new_price }}">

                                    <span style="color: red;">
                                        @error('new_price')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <label>Current Image</label><br>
                                    @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" width="100">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label>Change Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->





                </div>


                <!--/.col (left) -->
                <!-- right column -->

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category_id').on('change', function() {
            var categoryId = $(this).val();
            var subCategoryDropdown = $('#sub_category_id');

            subCategoryDropdown.empty().append('<option value="">Loading...</option>');

            if (categoryId) {
                $.ajax({
                    url: "{{ url('/get-subcategories') }}/" + categoryId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        subCategoryDropdown.empty().append('<option value="">Select Subcategory</option>');
                        $.each(data, function(key, value) {
                            subCategoryDropdown.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function() {
                        subCategoryDropdown.empty().append('<option value="">Error loading</option>');
                    }
                });
            } else {
                subCategoryDropdown.empty().append('<option value="">Select Subcategory</option>');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            placeholder: 'Write product description...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>



@endsection