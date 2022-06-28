@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <hr>
                <h2 style="color: teal; font-weight: bold;">My Final Assignment</h2>
                <h4 style="color: orange; font-weight: bold; background-color:teal;">Categories Page</h4>
                <hr>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.create') }}"> Create New Categories</a>
                <a class="btn btn-warning" href="sample" style="margin-left:80%">Home</a>

            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   <br>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Active</th>
            @if(auth()->user()->utype == '1'||auth()->user()->utype == '0')
                <th width="280px">Action</th>
            @endif
        </tr>
        @foreach ($category as $category)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->active }}</td>
            @if(auth()->user()->utype == '1'||auth()->user()->utype == '0')
            <td>
                <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
       
                    <a class="btn btn-warning" href="{{ route('categories.edit',$category->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </table>
  </div>
  
      
@endsection