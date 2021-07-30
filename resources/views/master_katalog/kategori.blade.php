@extends('layout.default')

@section('content')

@if($function == 'List')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kategori <a class="float-right" href="{{{ URL::route('kategori-form') }}}"><button type="button" class="btn btn-sm btn-primary">Tambah</button></a></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Gambar Kategori</th>
                                <th>Keterangan kategori</th>
                                <th>Status Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->nama_kategori }}</td>
                                <td>
                                    <div class="thumbnail">
                                        <img class="img img-fluid" src="{{ asset("file_upload/kategori/$dt->path_gambar_kategori") }}" alt="profile Pic" style="width:150px">
                                    </div>
                                </td>
                                <td>{{ ($dt->keterangan_kategori)  }}</td>
                                <td>{{ ($dt->status_kategori ==1 ? 'Aktif' : 'Non-Aktif')  }}</td>
                                <td><a href="<?php echo URL::route('kategori-form') . "/" . $dt->kategori_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>Edit</a></td>
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
            <h4 class="card-title">Formulir Kategori</h4>
            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{ route('kategori-submit',[$kategori_id]) }}">
                @if (!empty($kategori_id))
                    @method('put')
                @endif
                @csrf
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kategori name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('nama_kategori') ? 'is-invalid' : ''}}" id="nama_kategori" name="nama_kategori" placeholder="Kategori name" value="{{ !empty($kategori_id)?$nama_kategori : old('nama_kategori') }}">
                    {!! $errors->first('nama_kategori', '<p class="help-block">:message</p>') !!}
                    <input type="hidden" class="form-control" id="kategori_id" name="kategori_id" value="{{{ $kategori_id }}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kategori Order</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('order_kategori') ? 'is-invalid' : ''}}" id="order_kategori" name="order_kategori" placeholder="Feature Order" value="{{{ !empty($kategori_id)?$order_kategori : old('order_kategori') }}}">
                    {!! $errors->first('order_kategori', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                    <textarea class="form-control" id="keterangan_kategori" name="keterangan_kategori" placeholder="keterangan kategori" rows="3">{{{ !empty($kategori_id)?$keterangan_kategori : old('keterangan_kategori')}}}
                    </textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Foto kategori</label>
                    <div class="col-sm-9">
                    <input type="file" class="form-control-file {{ $errors->has('path_gambar_kategori') ? 'is-invalid' : ''}}" id="path_gambar_kategori" name="path_gambar_kategori"  value="{{{ !empty($kategori_id)?$path_gambar_kategori : old('path_gambar_kategori') }}}">
                    {!! $errors->first('path_gambar_kategori', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{{ route('kategori-list')}}}"><button type="button" class="btn btn-light">Batal</button></a>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                </div>
            </form>
            @if (!empty($kategori_id))
            <div class="float-left">
                <form class="forms-sample" method="POST" action="{{ route('kategori-delete',[$kategori_id]) }}">
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