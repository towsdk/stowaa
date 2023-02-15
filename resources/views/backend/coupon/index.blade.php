@extends('layouts.backend')
@section('title', 'Coupon')
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">Product Coupon</li>
                </ol>
            </nav>
            <h1 class="m-0">Coupon</h1>
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
                                    <th>Name</th>
                                    <th>Discount</th>
                                    <th>Limit</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                               
                                @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->name }}</td>
                                    <td>{{ $coupon->discount }}</td>
                                    <td>{{ $coupon->limit }}</td>
                                    <td>{{ ($coupon->expiry_date)->isoFormat('D MMM Y') }}</td>
                                    <td>{{ $coupon->status }}</td>
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
            <h4>Add coupon</h4>
            <div class="card-body">
                <form action="{{ route('backend.coupon.store') }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control mb-3" placeholder="Name" name="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $messag }}</p>
                    @enderror
                    <div class="form-group">
                        <input type="number" class="form-control mb-3" placeholder="Discount" name="discount" value="{{ old('discount') }}">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control mb-3" placeholder="Limit" name="limit" value="{{ old('limit') }}">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control mb-3" placeholder="Expiry Date" name="expiry_date" value="{{ old('expiry_date') }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">Add +</button>
                </form>
            </div>
        </div>
    </div>

</div>

</div>
</div>

@endsection
