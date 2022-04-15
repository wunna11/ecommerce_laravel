@extends('layouts.app_admin')

@section('title')
    Add Category
@endsection

@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Category</h4>

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

                    <form class="cmxform" id="commentForm" method="POST" action="{{ route('admin.save.category') }}">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="name">Name (required, at least 2 characters)</label>
                                <input id="name" class="form-control" name="name" minlength="2" type="text" value="{{ old('name') }}">
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
