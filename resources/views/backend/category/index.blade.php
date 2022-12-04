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
  <div class="row">
    <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Category</h4>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Product Count</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            @if ($category->image)
                                            <img width="60" src="{{ asset('storage/category/'.$category->image) }}" alt={{ "$category->name" }}  >
                                            @else
                                            <img  width="60"src="{{ asset('storage/category/cat.png') }}" alt={{ "$category->name" }}  > </td>
                                        </td>
                                            @endif
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>10</td>
                                            <td>{{ $category->status }}</td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">{{ __('not found') }}</td>
                                    </tr>
                                @endforelse
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
                            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
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