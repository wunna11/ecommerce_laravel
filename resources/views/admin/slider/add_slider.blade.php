@extends('layouts.app_admin')

@section('title')
    Add Slider
@endsection


@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Slider</h4>

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


                    <form class="cmxform" id="commentForm" method="POST" action="{{ route('admin.save.slider') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="">Description One</label>
                                <textarea name="description_one" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Description Two</label>
                                <textarea name="description_two" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Slider Image</label>
                                <input type="file" class="form-control" name="image" class="form-control">
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
