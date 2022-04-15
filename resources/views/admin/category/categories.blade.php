@extends('layouts.app_admin')

@section('title')
    Category List
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Category List</h4>

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
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <div class="form-row">
                                                <a href="{{ route('admin.edit.category', $category->id) }}" type="button" class="btn btn-outline-primary" style="margin-right: 10px">Edit</a>
                                                <form action="{{ route('admin.delete.category', $category->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you want to delete this item?');">Delete</button>
                                                </form>
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
