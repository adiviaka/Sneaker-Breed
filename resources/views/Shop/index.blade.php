@extends('layouts.admin')

@section('main-content')

   <h4 class="mt-5 ml-4">Shop</h4>

   <a href="{{ route('shop.create') }}" type="button" class="btn btn-primary rounded-3 ml-4">Add Shop</a>

   @if ($message = Session::get('success'))
      <div class="alert alert-success mt-3" role="alert">
         {{ $message }}
      </div>
   @endif

   <table class="table table-hover mt-4 mx-4">
      <thead>
         <tr>
            <th>Name</th>
            <th>Location</th>
            <th>Owner</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($shop as $data)
            <tr>
               <td>{{ $data->name_shop }}</td>
               <td>{{ $data->location_shop }}</td>
               <td>{{ $data->name_owner }}</td>
               <td>
                  <a href="{{ route('shop.edit', $data->id_shop) }}" type="button" class="btn btn-warning rounded-3">Edit</a>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                     data-bs-target="#hapusModal{{ $data->id_shop }}">
                     Delete
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="hapusModal{{ $data->id_shop }}" tabindex="-1"
                     aria-labelledby="hapusModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form method="POST" action="{{ route('shop.delete', $data->id_shop) }}">
                              @csrf
                              <div class="modal-body">
                                 Apakah anda yakin ingin menghapus {{ $data->name_shop }}?
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                 <button type="submit" class="btn btn-primary">Ya</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </td>
            </tr>
         @endforeach
      </tbody>
   </table>
@stop
