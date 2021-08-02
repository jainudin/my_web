@extends('layout.default')

@section('content')
<div class="row">
    <div class="float-left">
    <a href="{{{ route('produk-list')}}}"><button type="button" class="btn btn-light"><i class="fa fa-arrow-left"></i> Kembali Ke Produk</button></a>
   </div>
</div>

@if($function == 'List')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Foto Produk <a class="float-right" href="{{{ URL::route('list_gambar_produk-form',[$produk_id]) }}}"><button type="button" class="btn btn-sm btn-primary">Tambah</button></a></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kategori produk</th>
                                <th>Nama produk</th>
                                <th>Status Produk</th>
                                <th>Foto Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->list_gambar_produk_id }}</td>
                                <td>{{ $dt->list_gambar_produk_id }}</td>
                                <td>{{ $dt->list_gambar_produk_id  }}</td>
                                <td>{{ $dt->list_gambar_produk_id  }}</td>
                                <td><a href="{{ route('list_gambar_produk-delete',[$dt->produk_id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($function == 'Form')
<div class="row">
    <div class="col-12 stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Formulir List Foto Produk</h4>
            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{ route('produk-submit',[$produk_id]) }}">
                @if (!empty($produk_id))
                    @method('put')
                @endif
                @csrf
                              
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Foto Produk</label>
                    <div class="col-sm-9">
                    <input type="file" class="form-control-file {{ $errors->has('path_gambar_produk') ? 'is-invalid' : ''}}" id="path_gambar_produk" name="path_gambar_produk"  value="">
                    {!! $errors->first('path_gambar_produk', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{{ route('list_gambar_produk-list',[$produk_id])}}}"><button type="button" class="btn btn-light">Batal</button></a>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                </div>
            </form>
           
        </div>
        </div>
    </div>
</div>
@endif

@stop

@section('css-page')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@stop

@section('js-page')
    <script src="{{ asset('js/datatables.min.js') }}"></script>

    <script>
        $(function () {
            $(".table").DataTable();
        });
    </script>
    <script>
    $(document).ready(function(){
        $(function () {
            $('.btn-del').on('click', function () {
                return confirm('Hapus data ini?');
            });
        });
    });
    </script>
@stop