@extends('layouts.admin')

@section('main-content')



   <div class="container ml-4">
      <h4 class="mt-5 ">Shoes</h4>
      <form class="d-flex mb-4" role="search" action="{{ route('shoes.index') }}" method="GET">
         <input class="form-control me-2" id="search" name="search" value="{{ request('keyword') }}" type="search"
            placeholder="Find sneaker" aria-label="Search">
         <button class="btn btn-outline-success" type="submit">Search</button>
      </form>



      @if ($message = Session::get('success'))
         <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
         </div>
      @endif

      <a href="{{ route('shoes.create') }}" type="button" class="btn btn-primary rounded-3">Tambah Sneaker</a>

      <div class="row justify-content-center mt-3 mb-5">
         @foreach ($shoes as $item)
            <div class="card mr-3 mb-3" style="width: 18rem;padding:0px;background-color:#F6F6F6">
               <img src="{{ $item->gambar }}" class="card-img-top" style="height: 180px; object-fit:contain"
                  alt="...">
               <div class="card-body">
                  <h5 class="card-title">{{ $item->shoes_type }}</h5>
                  <p class="card-text">{{ $item->color }}</p>
                  {{-- <p> {{ $item->color }}</p> --}}
                  <p> {{ $item->price }}</p>
                  <a href="{{ route('shoes.edit', $item->id_shoes) }}" type="button"
                     class="btn btn-warning rounded-3">Edit</a>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                     data-bs-target="#hapusModal{{ $item->id_shoes }}">
                     Delete
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="hapusModal{{ $item->id_shoes }}" tabindex="-1"
                     aria-labelledby="hapusModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form method="POST" action="{{ route('shoes.destroy', $item->id_shoes) }}">
                              @csrf
                              <div class="modal-body">
                                 Apakah anda yakin ingin menghapus {{ $item->shoes_type }}?
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                 <button type="submit" class="btn btn-primary">Ya</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
      </div>

      <div class="row justify-content-center mt-3 mb-5">
         @foreach ($shoes_deleted as $item)
            <div class="card mr-3 mb-3" style="width: 18rem;padding:0px;background-color:#F6F6F6">
               <img src="{{ $item->gambar }}" class="card-img-top" style="height: 180px; object-fit:contain"
                  alt="...">
               <div class="card-body">
                  <h5 class="card-title">{{ $item->shoes_type }}</h5>
                  <p class="card-text">{{ $item->color }}</p>
                  {{-- <p> {{ $item->color }}</p> --}}
                  <p> {{ $item->price }}</p>
                  @method('POST')
                  <form method="POST" action="{{ route('shoes.restore', $item->id_shoes) }}">
                     @csrf
                     <button type="submit" class="btn btn-primary">Restore</button>
                  </form>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal"
                     data-bs-target="#hapusModal{{ $item->id_shoes }}">
                     Delete Permanent
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="hapusModal{{ $item->id_shoes }}" tabindex="-1"
                     aria-labelledby="hapusModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form method="POST" action="{{ route('shoes.forceDelete', $item->id_shoes) }}">
                              @csrf
                              <div class="modal-body">
                                 Apakah anda yakin ingin menghapus {{ $item->shoes_type }}?
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                 <button type="submit" class="btn btn-primary">Ya</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
      </div>
      {{-- <a href="{{ route('shoes.create') }}" type="button" class="btn btn-primary rounded-3 mb-2 mt-4">Tambah Bus</a> --}}

      {{-- <table class="table table-hover mt-4 ">
         <thead>
            <tr>
               <th>Merk</th>
               <th>Otobus</th>
               <th>Tipe</th>
               <th>Kelas</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($bus as $data)
               <tr>
                  <td>{{ $data->merk }}</td>
                  <td>{{ $data->otobus }}</td>
                  <td>{{ $data->tipe }}</td>
                  <td>{{ $data->kelas }}</td>
                  <td>
                     <a href="{{ route('bus.edit', $data->plat) }}" type="button"
                        class="btn btn-warning rounded-3">Edit</a>

                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#hapusModal{{ $data->plat }}">
                        Delete
                     </button>

                     <!-- Modal -->
                     <div class="modal fade" id="hapusModal{{ $data->plat }}" tabindex="-1"
                        aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                              </div>
                              <form method="POST" action="{{ route('bus.delete', $data->plat) }}">
                                 @csrf
                                 <div class="modal-body">
                                    Apakah anda yakin ingin menghapus {{ $data->otobus }}?
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
      </table> --}}
   </div>

@stop
