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
                        aria-current="page">Product</li>
                </ol>
            </nav>
            <h1 class="m-0">Product</h1>
        </div>
    </div>
</div>

<div class="container-fluid page__container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Category</h4>
                        <div class="card-body">
                            <table class="table table-responsive">
                               <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Categories</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                               </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/product/'.$product->image) }}" alt="" width="50">
                                        </td>
                                        <td>{{ Str::limit($product->title, 20, '...') }}</td>
                                        <td>{{ Str::limit($product->slug, 20, '...') }}</td>
                                        <td>
                                            @foreach ($product->categories as $category)
                                                <span class="badge badge-success">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $product->created_at->diffForHumans() }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td><a href="">Edit</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">{{ __('Product not found') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="mt-5">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
        </div>

</div>
</div>

@endsection
