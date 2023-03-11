@extends('layouts.backend')
@section('title', 'Orders id'.$singleOrder->id)
@section('content')
  <div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
      <div class="flex">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders ID:{{ $singleOrder->id }}</li>
          </ol>
        </nav>
        <h1 class="m-0">Orders: {{ $singleOrder->id }}
        <a href="" class="btn btn-primary">Completed</a></h1>
      </div>
    </div>
  </div>
{{ $singleOrder->shipping }}
  <div class="container-fluid page__container">
    <div class="row">
      <div class="col-lg-12 table-responsive">

        <div class="card">
          <div class="card-header">
            <h4>User Info</h4>
          </div>
          <div class="card-body">
            <table class="table">
               <tr>
                  <td><strong>ID</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->user->id }}</td>
               </tr>
               <tr>
                  <td><strong>Name</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->user->name }}</td>
               </tr>
               <tr>
                  <td><strong>Email</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->user->email }}</td>
               </tr>
               <tr>
                  <td><strong>Phone</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->user->user_info->phone }}</td>
               </tr>
               <tr>
                  <td><strong>Address</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->user->user_info->address }}</td>
               </tr>
               <tr>
                  <td><strong>City</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->user->user_info->city }}</td>
               </tr>
               <tr>
                  <td><strong>Zip</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->user->user_info->zip }}</td>
               </tr>
               
               
            </table>
          </div>
        </div>

        
       @if ($singleOrder->shipping)
       <div class="card mt-4">
        <div class="card-header">
          <h4>Shipping Info</h4>
        </div>
        <div class="card-body">
          <table class="table">
             <tr>
                <td><strong>ID</strong></td>
                <td>:</td>
                <td>{{ $singleOrder->shipping->id }}</td>
             </tr>
             <tr>
                <td><strong>Name</strong></td>
                <td>:</td>
                <td>{{ $singleOrder->shipping->name }}</td>
             </tr>
             <tr>
                <td><strong>Phone</strong></td>
                <td>:</td>
                <td>{{ $singleOrder->shipping->phone }}</td>
             </tr>
             <tr>
                <td><strong>Address</strong></td>
                <td>:</td>
                <td>{{ $singleOrder->shipping->address }}</td>
             </tr>
             <tr>
                <td><strong>City</strong></td>
                <td>:</td>
                <td>{{ $singleOrder->shipping->city }}</td>
             </tr>
             <tr>
                <td><strong>Zip</strong></td>
                <td>:</td>
                <td>{{ $singleOrder->shipping->zip }}</td>
             </tr>
             
             
          </table>
        </div>
      </div>
       @endif

        <div class="card mt-4">
          <div class="card-header">
            <h4>Order</h4>
          </div>
          <div class="card-body">
            <table class="table">
               <tr>
                  <td><strong>ID</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->id }}</td>
               </tr>
               <tr>
                  <td><strong>Total</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->total }}</td>
               </tr>
               <tr>
                  <td><strong>Transaction Id</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->transaction_id }}</td>
               </tr>
               <tr>
                  <td><strong>Coupon Name</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->coupon_name ?? '--' }}</td>
               </tr>
               <tr>
                  <td><strong>Coupon Amont</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->coupon_amount ?? '00' }}</td>
               </tr>
               <tr>
                  <td><strong>Shipping Charge</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->shipping_charge ?? '' }}</td>
               </tr>
               <tr>
                  <td><strong>Order Status</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->order_status ?? '' }}</td>
               </tr>
               <tr>
                  <td><strong>Payment Status</strong></td>
                  <td>:</td>
                  <td>{{ $singleOrder->payment_status ?? '' }}</td>
               </tr>
               
            </table>
          </div>
        </div>
        <div class="card mt-5">
          <div class="card-header">
            <h4>Product</h4>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                  <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Additional Amount</th>
                    <th>Color</th>
                    <th>Size</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($singleOrder->inventory_orders as $inventory_orders)
                  <tr>
                    <td>
                       <h5>{{ $inventory_orders->inventory->product->title }}</h5>
                    </td>
                    <td>{{ $inventory_orders->order_quantity }}</td>
                    <td>{{ $inventory_orders->order_amount }}</td>
                    <td>{{ $inventory_orders->additioal_amount ?? '--' }}</td>
                    <td>{{ $inventory_orders->inventory->color->name }}</td>
                    <td>{{ $inventory_orders->inventory->size->name }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')

  <script>
    $('.p_delete').on('click', function() {
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
    });
  </script>
@endsection