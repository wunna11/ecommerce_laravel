@extends('layouts.app_admin')

@section('title')
    Edit Product
@endsection


@section('content')
<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Product</h4>

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

                <form class="cmxform" id="commentForm" method="POST" action="{{ route('admin.update.product', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="name">Name (required, at least 2 characters)</label>
                            <input id="name" class="form-control" name="name" minlength="2" type="text" value="{{ $product->name }}">
                        </div>


                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" value="{{ $product->price }}">
                        </div>

                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="image" class="form-control" value="{{ $product->image }}">
                            <br>
                            <img src="{{ asset('storage/product_images/'.$product->image) }}" alt=""> 
                        </div>

                        <input class="btn btn-primary" type="submit" value="Update">
                        <a href="{{ route('admin.products') }}" type="button" class="btn btn-warning">Back</a>
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