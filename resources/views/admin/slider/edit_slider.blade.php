@extends('layouts.app_admin')

@section('title')
    Edit Slider
@endsection


@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Slider</h4>

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


                    <form class="cmxform" id="commentForm" method="POST" action="{{ route('admin.update.slider', $slider->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="">Description One</label>
                                <textarea name="description_one" class="form-control" id="" cols="30" rows="10">{{ $slider->description_one }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Description Two</label>
                                <textarea name="description_two" class="form-control" id="" cols="30" rows="10">{{ $slider->description_two }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image" class="form-control" value="{{ $slider->image }}">
                                <br>
                                <img src="{{ asset('storage/slider_images/'.$slider->image) }}" alt="" width="40%"> 
                            </div>
                            <input class="btn btn-primary" type="submit" value="Update">
                            <a href="{{ route('admin.sliders') }}" type="button" class="btn btn-warning">Back</a>
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
