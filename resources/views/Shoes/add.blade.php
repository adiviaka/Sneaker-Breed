@extends('layouts.admin')

@section('main-content')

   @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
   @endif

   <div class="card mt-4">
      <div class="card-body">

         <h5 class="card-title fw-bolder mb-3">Add Sneaker</h5>

         <form method="post" action="{{ route('shoes.store') }}">
            @csrf

            <div class="mb-3">
               <label for="gambar" class="form-label">Gambar</label>
               <input type="text" class="form-control" id="gambar" name="gambar">
            </div>
            <div class="mb-3">
               <label for="brand" class="form-label">Brand</label>
               <input type="text" class="form-control" id="brand" name="brand">
            </div>
            <div class="mb-3">
               <label for="shoes_type" class="form-label">Type</label>
               <input type="text" class="form-control" id="shoes_type" name="shoes_type">
            </div>
            <div class="mb-3">
               <label for="color" class="form-label">Color</label>
               <input type="text" class="form-control" id="color" name="color">
            </div>
            <div class="mb-3">
               <label for="price" class="form-label">Price</label>
               <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="mb-3">
               <label for="id_shop" class="form-label">Shop</label>
               <select class="form-select" id="id_shop" name="id_shop" aria-label="Default select example">
                  @foreach ($shop as $item)
                     <option value="{{ $item->id_shop }}">{{ $item->name_shop }}</option>
                  @endforeach
               </select>
            </div>
            <div class="text-center">
               <input type="submit" class="btn btn-primary" value="Submit" />
            </div>
         </form>
      </div>
   </div>

@stop
