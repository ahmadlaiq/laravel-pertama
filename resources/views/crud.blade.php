@extends('layouts.master')
@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <a href="/crud/tambah" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Data</a>
            <hr>
            @if (session('message'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>×</span>
                  </button>
                  {{session('message')}}
                </div>
              </div>
            @endif
            <table class="table table-bordered table-striped table-sm">
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Action</th>
                </tr>
                @foreach ($data_barang as $no => $data)
                <tr>
                    <td>{{ $data_barang->firstItem()+$no }}</td>
                    <td>{{ $data->kode_barang }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>
                        <a href="{{ route('crud.edit', $data->id)}}" class="badge badge-success">Edit</a>
                        <a href="#" data-id="{{ $data->id }}" class="badge badge-danger swal-confirm">
                            <form action="{{ route('crud.delete',$data->id)}}" id="delete{{ $data->id }}" method="POST">
                            @csrf
                            @method('delete')
                            </form>
                            Delete</a>
                    </td>  
                </tr>
                @endforeach
            </table>
            {{$data_barang->links()}}
        </div>
    </div>
</div>

@endsection

@push('page-scripts')
<script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>

@endpush

@push('after-scripts')
<script>
$(".swal-confirm").click(function(e) {
    id = e.target.dataset.id;
    swal({
        title: 'Apakah anda yakin?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            swal('Poof! Your imaginary file has been deleted!', {
            icon: 'success',
            });
        $(`#delete${id}`).submit();
        } else {
            swal('File anda aman');
        }
      });
  });
</script>
@endpush