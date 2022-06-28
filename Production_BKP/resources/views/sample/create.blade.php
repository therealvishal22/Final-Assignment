@extends('sample.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Sample</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('sample.index') }}"> Back</a>
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
   
<form action="{{ route('sample.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Enter Name">
            </div> 
        </div>

        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Categoty:</strong>
                <select name="category">
                   <option value="Select">Select</option>
                   @foreach($cat as $key => $sample)
                        <option value="{{$sample->name}}">{{$sample->name}}</option>
                    @endforeach

                </select>
            </div> 
        </div>

        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control" placeholder="Select Image">
            </div> 
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Created By User_ID:</strong>
                <input type=" " name="created_by" class="form-control" value=" {{ Auth::user()->email }}">
            </div> 
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Active:</strong>
                Yes:<input type="radio" name="active" value="Yes">  
                No:<input type="radio" name="active" value="No">    
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection