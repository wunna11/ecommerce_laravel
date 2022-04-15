@extends('layouts.app_admin')

@section('title')
    Add Product
@endsection


@section('content')
<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Product</h4>

                @if (Session('success'))
                    <div class="alert alert-success">{{ Session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="cmxform" id="commentForm" method="POST" action="{{ route('admin.save.product') }}" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="name">Name (required, at least 2 characters)</label>
                            <input id="name" class="form-control" name="name" minlength="2" type="text" value="{{ old('name') }}">
                        </div>


                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                        </div>

                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="image" class="form-control" value="{{ old('image') }}">  
                        </div>

                        <input class="btn btn-primary" type="submit" value="Add">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script src="{{ asset('js/bt-maxLength.js') }}"></script>
@endsection