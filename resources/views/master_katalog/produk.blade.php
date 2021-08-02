@extends('layout.default')

@section('content')

@if($function == 'List')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">produk <a class="float-right" href="{{{ URL::route('produk-form')}}}"><button type="button" class="btn btn-sm btn-primary">Tambah</button></a></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kategori produk</th>
                                <th>Nama produk</th>
                                <th>Status Produk</th>
                                <th>Foto Produk</th>
                                <th>List Foto Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->nama_kategori }}</td>
                                <td>{{ $dt->nama_produk }}</td>
                                <td>{{ ($dt->status_produk ==1 ? 'Aktif' : 'Non-Aktif')  }}</td>
                                <td>
                                    <div class="thumbnail">
                                        <img class="img img-fluid" src="{{ asset("file_upload/produk/$dt->path_gambar_produk") }}" alt="profile Pic" style="width:150px">
                                    </div>
                                </td>
                                <td><a href="<?php echo URL::route('list_gambar_produk-list') . "/" . $dt->produk_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-list"></i>Edit</a></td>
                                <td><a href="<?php echo URL::route('produk-form') . "/" . $dt->produk_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>Edit</a></td>
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
            <h4 class="card-title">Formulir Produk</h4>
            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{ route('produk-submit',[$produk_id]) }}">
                @if (!empty($produk_id))
                    @method('put')
                @endif
                @csrf
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama Kategori</label>
                    <div class="col-sm-9">
                        <select name="kategori_id" id="kategori_id" class="form-control input-lg">
                            <option value="">Select Kategori</option>
                            @foreach ($kategori as $k)
                            <option value="{{ $k->kategori_id }}" <?php if ($k->kategori_id === $kategori_id) { echo "selected"; }?>>{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama Produk</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('produk_name') ? 'is-invalid' : ''}}" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="{{{ !empty($produk_id)?$nama_produk : old('nama_produk') }}}">
                    {!! $errors->first('nama_produk', '<p class="help-block">:message</p>') !!}
                    <input type="hidden" class="form-control" id="produk_id" name="produk_id" value="{{{ $produk_id }}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                    <textarea class="form-control" id="keterangan_produk" name="keterangan_produk" placeholder="keterangan Produk" rows="3">{{{ !empty($produk_id)?$keterangan_produk : old('keterangan_produk')}}}
                    </textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Foto Produk</label>
                    <div class="col-sm-9">
                    <input type="file" class="form-control-file {{ $errors->has('path_gambar_produk') ? 'is-invalid' : ''}}" id="path_gambar_produk" name="path_gambar_produk"  value="{{{ !empty($produk_id)?$path_gambar_produk : old('path_gambar_produk') }}}">
                    {!! $errors->first('path_gambar_produk', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{{ route('produk-list')}}}"><button type="button" class="btn btn-light">Batal</button></a>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                </div>
            </form>
            @if (!empty($produk_id))
            <div class="float-left">
                <form class="forms-sample" method="POST" action="{{ route('produk-delete',[$produk_id]) }}">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            <div class="float-right">
            @endif
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