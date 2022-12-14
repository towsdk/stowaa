@extends('layouts.backend')
@section('title', 'Category')
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">Category</li>
                </ol>
            </nav>
            <h1 class="m-0">Category</h1>
        </div>
    </div>
</div>

<div class="container-fluid page__container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Category</h4>
                        <div class="card-body">
                            <table class="table table-responsive">
                               <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Product Count</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                               </thead>
                                <tbody>
                                    @forelse ($categories as $key=>$category)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if ($category->image)
                                            <img width="40" src="{{ asset('storage/category/'.$category->image) }}" alt={{ "$category->name" }}  >
                                            @else
                                            <img src="{{Avatar::create($category->name)->setDimension(30)->setFontSize(16)->toBase64();}}" alt="{{ $category->name}}">
                                        </td>
                                            @endif
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->products_count }}</td>
                                            <td>{{ $category->status }}</td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                    </tr>
                                    @foreach ($category->childCategories as $category)
                                    <tr style="background: #f1f1f1">
                                        <td>--</td>
                                        <td>
                                            @if ($category->image)
                                            <img width="40" src="{{ asset('storage/category/'.$category->image) }}" alt={{ "$category->name" }}  >
                                            @else
                                            <img src="{{Avatar::create($category->name)->setDimension(30)->setFontSize(16)->toBase64();}}" alt="{{ $category->name}}">
                                        </td>
                                            @endif
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{  $category->products_count  }}</td>
                                            <td>{{ $category->status }}</td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                    </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="5">{{ __('not found') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
     
  <div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h4>Add Category</h4>
            <div class="card-body">
                <form action="{{ route('backend.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control mb-3" 
                    placeholder="Add category" name="name"
                    value="{{ old('name') }}">
                    <select name="parent" class="form-control my-3 select_2">
                        <option value="" selected disabled>Parnet</option>
                        @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                 
                    @endforeach
                    </select>
                    <textarea name="description" placeholder="Description" class="form-control my-3" rows="5">{{ old('description') }}</textarea>
                    <input type="file" class="form-control my-3" name="image">
                    <button type="submit" class="btn btn-primary btn-sm mt-3">Add+</button>
                </form>
            </div>
        </div>
    </div>

</div>

</div>
</div>

@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"  />
@section('style')
    
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" ></script>
<script>
    $(function($){
        $('.select_2').select2();
    });
</script>
@endsection