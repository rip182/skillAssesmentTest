@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="card-body">
                    <form method="POST" action="/products" enctype="multipart/form-data">
                        @csrf
                        <!-- @method('POST') -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Upload Image</label>

                            <div class="col-md-6">
                                
                                <input  class="form-control" name="image" type="file" >
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @foreach ($images as $image)
                <div class="col-md-6 card w-75">
                    <div class="card-body">
                    <h5 class="card-title">{{$image->name}}</h5>
                    <img src="{{url('/thumbnail')}}/{{$image->image}}" alt="Image"/>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection