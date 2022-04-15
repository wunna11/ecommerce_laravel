@extends('layouts.app_admin')

@section('title')
    Product List
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Product List</h4>

            @if (Session('success'))
                <div class="alert alert-success">{{ Session('success') }}</div>
            @endif
            
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $product->id }}</td>
                                        <td><img src="{{ asset('storage/product_images/'.$product->image) }}" alt=""></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            @if ($product->status == 1)
                                                <label class="badge badge-success">Activated</label>
                                            @else
                                                <label class="badge badge-danger">Deactivated</label>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-row">
                                                <a href="{{ route('admin.edit.product', $product->id) }}" type="button" class="btn btn-outline-primary" style="margin-right: 10px">Edit</a>
                                                <form action="{{ route('admin.delete.product', $product->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you want to delete this item?')" style="margin-right: 10px">Delete</button>
                                                </form>
                                                @if ($product->status == 1)
                                                    <a href="{{ route('admin.deactivate.product', $product->id) }}" class="btn btn-outline-warning">Deactivate</a>
                                                @else
                                                    <a href="{{ route('admin.activate.product', $product->id) }}" class="btn btn-outline-success">Activate</a>
                                                @endif
                                            </div>
                                            
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
