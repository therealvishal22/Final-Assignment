@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 style="color:teal; font-weight: bold;text-align:center">My Final Assignment</h2>
            </div>
            <div class="pull-right" style="background-color:tan">
                <a class="btn btn-primary" href="{{ route('sample.create') }}"> Create New Sample</a>
                <a class="btn btn-info" href="categories" style="margin-left:75%;">Category</a>
                <a class="btn btn-info" href="products">Admin</a>
               
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   <br>
    <table class="table table-striped" style="background-color: wheat;">
        <tr style="font-size:16px; font-weight:bold;background-color:cadetblue">
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Image</th>
            <th>Created_By</th>
            <th>Active</th>
            @if(auth()->user()->utype == '1' || auth()->user()->utype == '0')
            <th width="280px">Action</th>
            @endif
        </tr>
        @foreach ($sample as $sample)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $sample->name }}</td>
            <td>{{ $sample->category }}</td>
            <td><img src="{{ asset('./public/images/' . $sample->image) }}" style="height: 100px; width: 100px;"></td>
            <td>{{$sample->created_by}}</td>
            <td>{{$sample->active}}</td>
            @if(auth()->user()->utype == '1' || auth()->user()->utype == '0')
            <td>
                <form action="{{ route('sample.destroy',$sample->id) }}" method="POST" enctype="multipart/form-data">
    
                    <a class="btn btn-warning" href="{{ route('sample.edit',$sample->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
           
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endif
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</div>
   
      
@endsection


