@extends('layouts.backend')
@section('title', 'Shipping_Charge')
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page"> Shipping Charge</li>
                </ol>
            </nav>
            <h1 class="m-0">Shipping Charge</h1>
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
                                <tr>
                                    <th>Id</th>
                                    <th>Location</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                               
                                @foreach ($shippings as $shipping)
                                <tr>
                                    <td>{{ $shipping->id }}</td>
                                    <td>{{ $shipping->location }}</td>
                                    <td>{{ $shipping->charge }}</td>
                                    <td>{{ $shipping->status }}</td>
                                     <td>
                                        <a href=""></a>
                                     </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
        </div>
     
  <div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h4>Add shipping charge</h4>
            <div class="card-body">
                <form action="{{ route('backend.shipping.charge.store') }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control mb-3" placeholder="Location" name="location" value="{{ old('location') }}">
                    </div>
                    @error('location')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <input type="number" class="form-control mb-3" placeholder="Amount" name="charge" value="{{ old('charge') }}">
                    </div>
                    @error('charge')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="btn btn-primary btn-sm mt-2">Add +</button>
                </form>
            </div>
        </div>
    </div>

</div>

</div>
</div>

@endsection
