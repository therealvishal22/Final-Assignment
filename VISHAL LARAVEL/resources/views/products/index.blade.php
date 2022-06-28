@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <hr>
                <h2 style="color: teal; font-weight: bold;">My Final Assignment</h2>
                <h4 style="color: orange; font-weight: bold; background-color:teal;">Admin Page</h4>
                <hr>
            </div>
            <div class="pull-right">
            @if(auth()->user()->utype == '1')
                <a class="btn btn-primary" href="{{ route('products.create') }}"> Create New Admin</a>
                @endif
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
            <th>Gender</th>
            <th>Hobbies</th>
            <th>Email</th>
            @if(auth()->user()->utype == '1')
                <th width="280px">Action</th>
            @endif
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->gender }}</td>
            <td>
                @foreach($product->hobbies as $value)
                    {{$value}},
                @endforeach
            </td>
            <td>{{ $product->email }}</td>
            @if(auth()->user()->utype == '1')
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST" enctype="multipart/form-data">

                    <a class="btn btn-warning" href="{{ route('products.edit',$product->id) }}">Edit</a>
   
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
  
    {!! $products->links() !!}
      
@endsection