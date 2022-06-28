@extends('sample.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit sample</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-dark" href="{{ route('sample.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('sample.update',$sample->id) }}" method="POST"  enctype="multipart/form-data">
    @csrf
    @method('PUT')
    

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $sample->name }}" class="form-control" placeholder="Name">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
                <select name="category">
                <option value="" disabled>Select</option>
                @foreach($jay as $key => $value)
                <option value="{{$value->name}}" {{$sample->category==$value->name ? "selected":""}}>{{$value->name}}</option>
                @endforeach
                </select>
            </div> 
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" value="{{$sample->image}}" class="form-control" placeholder="Select Image">
            </div> 
        </div>

        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Created By User ID:</strong>
                <input type="text" name="created_by" value="{{$sample->created_by}}" class="form-control">
            </div> 
        </div> -->

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Active:</strong>
                <input type=radio name="active" value="Yes" {{ $sample->active == 'Yes' ? 'checked' : ''}}>Yes</option>
                <input type=radio name="active" value="No" {{ $sample->active == 'No' ? 'checked' : ''}}>No</option>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>

</form>
@endsection