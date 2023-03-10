@extends('layouts.backend')
@section('title', 'Orders id'.$order->id)
@section('content')
  <div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
      <div class="flex">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
          </ol>
        </nav>
        <h1 class="m-0">Orders ID:{{ $order->id }}</h1>
      </div>
    </div>
  </div>

  <div class="container-fluid page__container">
    <div class="row">
      <div class="col-lg-12 table-responsive">
        <div class="card">
          <div class="card-body">
            <table class="table">
             
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