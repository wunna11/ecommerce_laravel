@extends('layouts.app_admin')

@section('title')
    Slider List
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Slider List</h4>

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
                                    <th>Desc One</th>
                                    <th>Desc Two</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $slider->id }}</td>
                                        <td><img src="{{ asset('storage/slider_images/'.$slider->image) }}" alt=""></td>
                                        <td>{{ substr($slider->description_one, 0, 15) . '...' }}</td>
                                        <td>{{ substr($slider->description_two, 0, 15) . '...' }}</td>
                                        <td>
                                            @if ($slider->status == 1)
                                                <label class="badge badge-success">Activated</label>
                                            @else
                                                <label class="badge badge-danger">Deactivated</label>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-row">
                                                <a href="{{ route('admin.edit.slider', $slider->id) }}" type="button" class="btn btn-outline-primary" style="margin-right: 10px">Edit</a>
                                                <form action="{{ route('admin.delete.slider', $slider->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you want to delete this item?')" style="margin-right: 10px">Delete</button>
                                                </form>
                                                @if ($slider->status == 1)
                                                    <a href="{{ route('admin.deactivate.slider', $slider->id) }}" class="btn btn-outline-warning">Deactivate</a>
                                                @else
                                                    <a href="{{ route('admin.activate.slider', $slider->id) }}" class="btn btn-outline-success">Activate</a>
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
