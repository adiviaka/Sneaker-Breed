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

         <form method="post" action="{{ route('owner.update', $data->id_owner) }}">
            @csrf
            <div class="mb-3">
               <label for="name_owner" class="form-label">Name</label>
               <input type="text" class="form-control" id="name_owner" name="name_owner" value="{{ $data->name_owner }}">
            </div>
            <div class="mb-3">
               <label for="telp" class="form-label">Telephone</label>
               <input type="text" class="form-control" id="telp" name="telp" value="{{ $data->telp }}">
            </div>
            <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
            </div>
            <div class="text-center">
               <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
         </form>
      </div>
   </div>

@stop
