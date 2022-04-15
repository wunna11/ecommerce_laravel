@extends('layouts.app_admin')

@section('title')
    Edit Category
@endsection

@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>

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

                    <form class="cmxform" id="commentForm" method="POST" action="{{ route('admin.update.category', $category->id) }}">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="name">Name (required, at least 2 characters)</label>
                                <input id="name" class="form-control" name="name" minlength="2" type="text" value="{{ $category->name }}">
                            </div>
                            <input class="btn btn-primary" type="submit" value="Update">
                            <a href="{{ route('admin.categories') }}" type="button" class="btn btn-warning">Back</a>
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
