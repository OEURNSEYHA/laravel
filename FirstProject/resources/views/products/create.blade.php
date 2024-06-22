@extends('layout.app')

@section('content')
<div class="contentpage">
    <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
        @csrf
       
        <div class="mb-3">

            <label for="" class="form-label">Name Product <span style="color:red"> {{$errors->first('name')}} </span> </label>
            <input type="text" name="name" id="name" class="form-control" >

        </div>
        <div class="mb-3">
            <label for="exampleInputdescription" class="form-label">Description</label>
            <textarea name="description" id="description" cols="1" rows="5" class="form-control"></textarea>

        </div>
        <div class="mb-3">

            <label for="" class="form-label">Inventory</label>
            <input type="text" name="quantity" id="quantity" class="form-control">

        </div>
        <div class="mb-3">

            <label for="" class="form-label">Price</label>
            <input type="text" name="price" id="price" class="form-control">

        </div>
        <div class="mb-3">

            <label for="exampleInputname" class="form-label">Category</label>
            <select name="category" id="category" class="form-control">
                @foreach( 
                    json_decode('{ 
                        "SmartPhnone":"SmartPhnone",
                        "Smart TV":"Smart TV",
                        "Computer":"Computer"}', 
                        true) as $optionkey => $optionvalue
                        )
                <option value="{{$optionkey}}"> {{$optionvalue}}</option>

                @endforeach
                
                
            </select>

        </div>
        <div class="mb-3">

            <label for="exampleInputname" class="form-label">Image <span style="color:red"> {{$errors->first('image')}} </span></label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection('content')