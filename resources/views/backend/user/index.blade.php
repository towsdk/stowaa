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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#active" type="button">Active</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#deactive" type="button">Deactive</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#trash" type="button">Trash</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="active">
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
                                    {{-- <th>Action</th> --}}
                                </tr>
                               </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/product/'.$product->image) }}" alt="" width="50">
                                        </td>
                                        <td>
                                            {{ Str::limit($product->title, 20, '...') }}
                                            <div class="my-2">
                                                <a href="{{ route('backend.inventory.index', $product->id) }}" class="btn btn-sm btn-success">+ Store</a>
                                                <a href="" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('backend.product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('backend.product.destroy', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($product->slug, 20, '...') }}</td>
                                        <td>
                                            @foreach ($product->categories as $category)
                                                <span class="badge badge-success">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $product->created_at->diffForHumans() }}</td>
                                        <td>{{ $product->status }}</td>
                                        {{-- <td><a href="">Edit</a></td> --}}
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
            <div class="tab-pane fade" id="deactive">
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
                                    {{-- <th>Action</th> --}}
                                </tr>
                               </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/product/'.$product->image) }}" alt="" width="50">
                                        </td>
                                        <td>
                                            {{ Str::limit($product->title, 20, '...') }}
                                            <div class="my-2">
                                                <a href="" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('backend.product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('backend.product.destroy', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($product->slug, 20, '...') }}</td>
                                        <td>
                                            @foreach ($product->categories as $category)
                                                <span class="badge badge-success">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $product->created_at->diffForHumans() }}</td>
                                        <td>{{ $product->status }}</td>
                                        {{-- <td><a href="">Edit</a></td> --}}
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
            <div class="tab-pane fade" id="trash">
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
                                    {{-- <th>Action</th> --}}
                                </tr>
                               </thead>
                                <tbody>
                                    @forelse ($trashedProducts as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/product/'.$product->image) }}" alt="" width="50">
                                        </td>
                                        <td>
                                            {{ Str::limit($product->title, 20, '...') }}
                                            <div class="my-2">
                                                <a href="{{ route('backend.product.restore', $product->id) }}" class="btn btn-sm btn-success">Restore</a>
                                                <form action="{{ route('backend.product.permanent.delete', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger p_delete">Permenant Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($product->slug, 20, '...') }}</td>
                                        <td>
                                            @foreach ($product->categories as $category)
                                                <span class="badge badge-success">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $product->created_at->diffForHumans() }}</td>
                                        <td>{{ $product->status }}</td>
                                        {{-- <td><a href="">Edit</a></td> --}}
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

</div>
</div>
@endsection

@section('script')
    <script>
        $('.p_delete').on('click', function(){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
               $(this).parent('form').submit();
            }
            })
        })
    </script>
@endsection