@extends('layouts.frontend')

@section('content')
        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="index-2.html">Home</a></li>
                    <li>My Account</li>
                </ul>
            </div>
        </div>

        <section class="account_section section_space">
            <div class="container">
                <div class="row">
                   @include('frontend.userdashboard.sidebar')

                    <div class="col col-lg-9">
                        <div class="account_content_area">
                            <h3>My Dashboard</h3>
                            <table class="table">
                                <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Total</th>
                                     <th>Order Status</th>
                                     <th>Payment Status</th>
                                     <th>Order Date</th>
                                     <th>Invoice</th>
                                     <th>Action</th>
                                 </tr>
                                </thead>
                                <tbody>
                                 @foreach (auth()->user()->orders as $order)
                                     <tr>
                                         <td>{{ $order->id }}</td>
                                         <td>{{ $order->total }}</td>
                                         <td>{{ $order->order_status }}</td>
                                         <td>{{ $order->payment_status }}</td>
                                         <td>{{ $order->created_at->isoFormat('DD-MMM-YYYY') }}</td>
                                         <td>
                                            <a href="{{ route('user.order.invoice', $order->id) }}" class="btn btn-primary">Download</a>
                                         </td>
                                         <td>
                                             <a href="" class="btn btn-sm btn-primary">View</a>
                                           </td>
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection