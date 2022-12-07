@extends('layouts.backend')
@section('title', 'Color')
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">Product Color</li>
                </ol>
            </nav>
            <h1 class="m-0">Color</h1>
        </div>
    </div>
</div>

<div class="container-fluid page__container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Color</h4>
                        <div class="card-body">
                            <table class="table">
                               <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                               </thead>
                                <tbody>
                                    @forelse ($colors as $color)
                                    <tr>
                                        <td>{{ $color->id }}</td>
                                          
                                            <td>{{ $color->name }}</td>
                                            <td>{{ $color->slug }}</td>
                                            <td>{{ $color->status }}</td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                    </tr>
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
            <h4>Add color</h4>
            <div class="card-body">
                <form action="{{ route('backend.color.store') }}" method="POST" >
                    @csrf
                    <input type="text" class="form-control mb-3" 
                    placeholder="Add color" name="name"
                    value="{{ old('name') }}">
                    <button type="submit" class="btn btn-primary btn-sm mt-3">Add+</button>
                </form>
            </div>
        </div>
    </div>

</div>

</div>
</div>

@endsection
