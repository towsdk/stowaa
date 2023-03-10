@extends('layouts.backend')
@section('title', 'Order')
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">Order</li>
                </ol>
            </nav>
            <h1 class="m-0">Order</h1>
        </div>
    </div>
</div>

<div class="container-fluid page__container">
  <div class="row justify-content-center">
    <div class="col-12">
        
        <form action="{{ route('backend.order.index') }}" method="GET">

          <div class="row align-items-end">
            <div class="col-xl-2 col-lg-3 mb-3">
              <input type="search" name="order_id" class=" form-control" placeholder="Order Id"
                value="{{ request()->order_id ?? '' }}">
            </div>
            <div class="col-xl-2 col-lg-3 mb-3">
              <select name="order_status" class=" form-control">
                <option selected disabled>Order Status</option>
                <option value="Pending" {{ request()->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Processing" {{ request()->order_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                <option value="Complete" {{ request()->order_status == 'Complete' ? 'selected' : '' }}>Complete</option>
                <option value="Cancel" {{ request()->order_status == 'Cancel' ? 'selected' : '' }}>Cancel</option>
              </select>
            </div>
            <div class="col-xl-2 col-lg-3 mb-3">
              <select name="payment_status" class=" form-control">
                <option selected disabled>Payment Status</option>
                <option value="Paid" {{ request()->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                <option value="Unpaid" {{ request()->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
              </select>
            </div>
            <div class="col-xl-2 col-lg-3 mb-3">
              <label for="">From</label>
              <input type="date" name="from_date" class=" form-control" value="{{ request()->from_date ?? '' }}">
            </div>
            <div class="col-xl-2 col-lg-3 mb-3">
              <label for="">To</label>
              <input type="date" name="to_date" class=" form-control" value="{{ request()->to_date ?? '' }}">
            </div>
            <div class="col-xl-2 col-lg-3 mb-3">
              <input type="submit" class=" btn btn-success" value="Search">
              <a href="{{ route('backend.order.index') }}" class=" btn btn-warning">Reset</a>
            </div>
          </div>
        </form>
      </div>
    <div class=" col-lg-12 table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h4>Category</h4>
                        <div class="card-body">
                            <table class="table">
                               <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Total</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                               </thead>
                               <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->order_status }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>{{ $order->created_at->isoFormat('DD-MMM-YYYY') }}</td>
                                        <td>
                                            <a href="{{ route('backend.order.show',$order->id) }}" class="btn tbn-sm btn-primary">View</a>
                                          </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                  </div>
              </div>
              <div class="class-footer">
                {{ $orders->links() }}
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