@extends('layouts.backend')
@section('title', 'Product Create')
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">Product Create</li>
                </ol>
            </nav>
            <h1 class="m-0">Product Create</h1>
        </div>
    </div>
</div>

<div class="container-fluid page__container">
    <form action="{{ route('backend.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
</div>
  <div class="row ">
            
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Product Description</h4>
                <div class="card-body">
                    
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select name="category_id[]" id="" class="form-control select_2" multiple>
                                <option disabled >Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Sku-code">Sku-code</label>
                            <input class="form-control" type="text" name="Sku_code" placeholder="Sku-code" value="{{ old('sku_code') }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input class="form-control" type="number" name="price" placeholder="Price" value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label for="SalePrice">Sale Price</label> 
                            <input  class="form-control" type="number" name="sale_price" placeholder="Sale Price" value="{{ old('sale_price') }}">
                        </div>
                        <div class="form-group">
                            <label for="currenct">Select Currency</label>
                            <select name="currency" id="" class="form-control">
                                <option disabled selected>Currency</option>
                                <option value="usd">USD</option>
                                <option value="bdt">BDT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Select Preview image</label> 
                            <input type="file" name="image" class="form-control">
                        </div>
                 
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Product Gallery </h4>
                <div class="card-body">
                        <div class="form-group">
                            <label for="image">Product Gallery image</label> 
                            <input type="file" name="gallery[]" class="form-control" multiple>
                        </div>
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="btn form-control btn-primary">Add Product<i class="fas fa-plus"></i></button>
        </div>
        </div>
  


  <div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h4>Additional Information</h4>
            <div class="card-body">
                <form action="{{ route('backend.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="form-group">
                        <label for="short-description">Short description</label>
                        <textarea class="form-control" name="short_description"placeholder="Short Description" cols="30" rows="5">{{ old('short_description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control summernote" name="description"placeholder=" Description" cols="30" rows="5">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="short-description">Additional Information</label>
                        <textarea class="form-control summernote" name="add_info "placeholder="Short Description" cols="30" rows="5">{{ old('add_info') }}</textarea>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
    </div>


</div>
</form>
</div>

@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"  />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css"  />
@section('style')
    
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js" ></script>
<script>
    $(function($){
        $('.select_2').select2();
    });

    $('.summernote').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 2,
        height: 200,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
</script>
@endsection