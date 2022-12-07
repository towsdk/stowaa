@extends('layouts.backend')
@section('title', 'Role & Permission')
@section('content')

<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <h1 class="m-0">Dashboard</h1>
        </div>
    </div>
</div>

<div class="container-fluid page__container">
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h4>Permission</h4>
                <form action="{{ route('backend.role.permission.store') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control" 
                    placeholder="Add Permission" name="name"
                    value="{{ old('permission') }}">
                    <button type="submit" class="btn btn-primary btn-sm mt-3">Add+</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Role</h4>
                <form action="{{ route('backend.role.permission.store') }}" method="POST">
                    @csrf
                    <div>
                        <input type="text" class="form-control mb-2" 
                    placeholder="Add Role" name="name"
                    value="{{ old('role') }}">
                    </div>
                  <div class="mb-2 mt-2">
                    @foreach ($permissions as $permission)
                    <label class="pr-2 col-2 border-1">
                      <input type='checkbox' name='permission[]' value='{{$permission->id  }}' />{{ $permission->name }}
                     </label>
                 @endforeach
                  </div>
                  <div>
                    <button type="submit" class="btn btn-primary btn-sm mt-3">Add+</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection