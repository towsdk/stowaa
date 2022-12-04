@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All Users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                       @foreach ($users as $user)
                       <tr>
                        <td>{{$user->id  }}</td>
                        <td>{{$user->name  }}</td>
                        <td>{{$user->email  }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-primary">Edit</a>
                            @can('edit user')
                            <a href="" class="btn btn-sm btn-primary">Delete</a>
                            @endcan
                            @can('delete user')
                            <a href="" class="btn btn-sm btn-primary">View</a>
                          @endcan
                            
                        </td>
                    </tr>
                       @endforeach
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
