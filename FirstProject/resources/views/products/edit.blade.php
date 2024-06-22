@extends('layout.app')

@section('content')
<div class="contentpage">
    <form method="post" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       {{-- @if ($errors->any)
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
       @else
           
       @endif --}}
        <div class="mb-3">

            <label for="" class="form-label">Name Product <span style="color:red"> {{$errors->first('name')}} </span> </label>
            <input type="text" name="name" id="name" class="form-control" value="{{$product->name}}">

        </div>
        <div class="mb-3">
            <label for="exampleInputdescription" class="form-label">Description</label>
            <textarea name="description" id="description" cols="1" rows="5" class="form-control"  value="{{$product->description}}">{{$product->description}}</textarea>

        </div>
        <div class="mb-3">

            <label for="" class="form-label">Inventory</label>
            <input type="text" name="quantity" id="quantity" class="form-control" value="{{$product->quantity}}">

        </div>
        <div class="mb-3">

            <label for="" class="form-label">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{$product->price}}">

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
                <option 
                    value="{{$optionkey}}"
                    {{(isset($product->category) && $product->category  === $optionkey) ? 'selected' : ''}}
                > 
                    {{$optionvalue}}
                </option>

                @endforeach
                
                
            </select>

        </div>
        <div class="mb-3">

            <label for="exampleInputname" class="form-label">Image <span style="color:red"> {{$errors->first('image')}} </span></label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" value="{{$product->image}}">
            <input type="text" name="hidden_image" value="{{$product->image}}">
        </div>
        <input type="text" name="hidden_id" value="{{$product->id}}" >
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection('content')