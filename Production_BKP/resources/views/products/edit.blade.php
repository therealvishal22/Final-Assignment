@extends('products.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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

<form action="{{ route('products.update',$product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Gender:</strong>
                <input type=radio name="gender" value="Male" {{ $product->gender == 'male' ? 'checked' : ''}}>Male</option>
                <input type=radio name="gender" value="Female" {{ $product->gender == 'female' ? 'checked' : ''}}>Female</option>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Hobbies:</strong><br>
                <input class="form-check-input" type="checkbox" name="hobbies[]" value="Cricket" {{ in_array('Cricket', $product->hobbies ) ? 'checked' : '' }}> Cricket
                <input class="form-check-input" type="checkbox" name="hobbies[]" value="Singing" {{ in_array('Singing', $product->hobbies ) ? 'checked' : '' }}> Singing
                <input class="form-check-input" type="checkbox" name="hobbies[]" value="Swimming" {{ in_array('Swimming', $product->hobbies ) ? 'checked' : '' }}> Swimming
                <input class="form-check-input" type="checkbox" name="hobbies[]" value="Shopping" {{ in_array('Shopping', $product->hobbies ) ? 'checked' : '' }}> Shopping
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" value="{{ $product->email }}" class="form-control" placeholder="Enter Email">
            </div>
        </div>

        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" value="{{ $product->password }}" class="form-control" placeholder="Enter Password">
            </div>
        </div> -->

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>

</form>
@endsection