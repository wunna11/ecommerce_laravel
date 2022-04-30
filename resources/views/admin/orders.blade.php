@extends('layouts.app_admin')

@section('title')
    Order List
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Order List</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Client Name</th>
                                    <th>Address</th>
                                    <th>Cart</th>
                                    <th>Payment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>

                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>
                                        @foreach ($order->cart->items as $item)
                                            {{ $item['name']}}
                                        @endforeach
                                    </td>
                                    <td>{{ $order->payment_id }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{route('view_pdf', $order->id) }}">View</a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script src="{{ asset('backend/js/data-table.js') }}"></script>
@endsection
