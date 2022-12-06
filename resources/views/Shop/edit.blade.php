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

         <h5 class="card-title fw-bolder mb-3">Ubah Data Jadwal</h5>

         <form method="post" action="{{ route('shop.update', $data->id_shop) }}">
            @csrf
            <div class="mb-3">
               <label for="name_shop" class="form-label">Name</label>
               <input type="text" class="form-control" id="name_shop" name="name_shop" value="{{ $data->name_shop }}">
            </div>
            <div class="mb-3">
               <label for="location_shop" class="form-label">Location</label>
               <input type="text" class="form-control" id="location_shop" name="location_shop"
                  value="{{ $data->location_shop }}">
            </div>
            <div class="mb-3">
               <label for="id_owner" class="form-label">Owner before {{ $data->name_owner }}</label>
               <select class="form-select" id="id_owner" name="id_owner" aria-label="Default select example">
                  @foreach ($owner as $b)
                     <option value="{{ $b->id_owner }}">{{ $b->name_owner }}</option>
                  @endforeach
               </select>
            </div>
            <div class="text-center">
               <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
         </form>
      </div>
   </div>

@stop
