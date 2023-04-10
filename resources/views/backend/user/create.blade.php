@extends('layouts.backend')
@section('title', 'User Create')
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">User Create</li>
                </ol>
            </nav>
            <h1 class="m-0">User Create</h1>
        </div>
    </div>
</div>

<div class="container-fluid page__container">
    <form action="{{ route('backend.user.store') }}" method="POST">
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
                <h4>User Description</h4>
                <div class="card-body">
                    
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="Sku-code">Email</label>
                            <input class="form-control" type="text" name="email" placeholder="email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" placeholder="password" value="{{ old('password') }}">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="password"required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label >Role:</label> 
                            <select name="role" class="form-control">
                                <option selected disabled>Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                 
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="btn form-control btn-primary">Add Product<i class="fas fa-plus"></i></button>
        </div>
        </div>
  



</div>
</form>
</div>

@endsection
