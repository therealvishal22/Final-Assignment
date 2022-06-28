@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <hr>
            <div class="pull-left">
                <h2 style="text-align:center; color:orange; background-color:teal; font-weight: bold">Welcome Page</h2>
            </div>
            <hr>
            <div class="pull-left">
                <p style="font-weight: bold;color:teal">My Final Assignment
                <select id="category_id" name="cat_id" class="btn btn-info" style="margin-left:80%">
                    <option value="">Select</option>
                    @foreach($jay as $key => $value)
                    <option value="{{ $value->name}}">{{ $value->name}}</option>
                    @endforeach
                </select></p>
            </div>
            <hr>

        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Image</th>
            <th>Created_By</th>
            <th>Active</th>
        </tr>
        <tbody id="tbody">
            @foreach ($sample as $sample)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $sample->name }}</td>
                <td>{{ $sample->category }}</td>
                <td><img src="{{ asset('public/images/'. $sample->image)}}" width="100" height="80"></td>
                <td>{{$sample->created_by}}</td>
                <td>{{$sample->active}}</td>
              
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
<script>
    $(document).ready(function() {
        $('#category_id').change(function() {
            var category = $(this).val();
            $.ajax({
                url: "{{ url('filterProduct') }}",
                type: "GET",
                data: {
                    'category': category
                },
                success: function(data) {
                    var products = data;
                    var html = '';
                    if (products.length > 0) {
                        for (let i = 0; i < products.length; i++) {
                            html += '<tr>\
                                        <td>' + (i +1) + '</td>\
                                        <td>' + products[i]['name'] + '</td>\
                                        <td>' + products[i]['category'] + '</td>\
                                        <td>' + products[i]['created_by'] + '</td>\
                                        <td>' + products[i]['active'] + '</td>\
                                        <td> <img src="public/images/' + products[i]['image']+'"width="100" height="80"></td>\
                                        </tr>';
                        }
                    } else {
                        html += '<tr>\
                                    <td>No Products Found</td>\
                                    </tr>';
                    }
                    $("#tbody").html(html);
                }
            });
        });
    });
</script>

@endsection