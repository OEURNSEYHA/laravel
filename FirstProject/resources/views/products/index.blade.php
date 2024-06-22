@extends('layout.app')
@section('content')



<div class="contentpage">

    <h1 align="center"> Product Lists </h1>
    <a href="{{route('products.create')}}" class="btn-add">ADD</a>
    
    <form method="GET" action="{{ route('products.index') }}" accept-charset="UTF-8" role="search">
        <div class="barsearch">

            <input type="text" name="search" id="search" class="search" placeholder="Search" value="{{request('search')}}">
            <input type="submit" class="btn-search">
        </div>
    </form>
    
    @if ($massage = Session::get('success'))
        <script type="text/javascript">
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                
                Toast.fire({
                    icon: 'success',
                    title: '{{$massage}}'
                })
        </script>
    @endif
    <table id="customers">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>


        @if (count($products) > 0)
            @foreach ($products as $product)
            <tr>
                <td>{{$product -> id}}</td>
                <td>{{$product -> name}}</td>
                <td>{{$product -> description}}</td>
                <td>{{$product -> category}}</td>
                <td>{{$product -> quantity}}</td>
                <td>{{$product -> price}}</td>
                <td><img src="{{asset('images/'. $product->image)}}" alt="" width="60" height="40"></td>
                <td style="display:flex; gap:10px">
                    <a href="{{route('products.edit', $product->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{route('products.destroy', $product->id)}}" method="POST" >
                        @csrf
                        @method('delete')
                        <button
                        style="background-color:transparent; border:none; color:red"
                        onclick="deleteConfirm(e)"
                        > <i class="fa-solid fa-trash"></i></button>
                  
                    </form>
                    
                </td>
            </tr>
            @endforeach
        @else

            <h5 align="center">Product Not found</h5>

        @endif

       
    </table>
    {{$products -> links('layout.pagination')}}
    <select name="" id="" onchange="getDataPerPage(this->value)">
        <option value="5">5</option>
        <option value="15">15</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
   
    
</div>
<script>
    window.deleteConfirm = function(e){
        e.preventDefault();
        let form = e.target.form;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
           form.submit();
        }
        })
    }
</script>
@endsection('content')