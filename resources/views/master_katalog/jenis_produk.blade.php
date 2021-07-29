@extends('layout.default')

@section('content')

@if($function == 'List')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Jenis Produk <a class="float-right" href="{{{ URL::route('jenis_produk-form') }}}"><button type="button" class="btn btn-sm btn-primary">Tambah</button></a></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Jenis Produk</th>
                                <th>Status Jenis Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->nama_jenis_produk }}</td>
                                <td>{{ ($dt->status_jenis_produk ==1 ? 'Aktif' : 'Non-Aktif')  }}</td>
                                <td><a href="<?php echo URL::route('jenis_produk-form') . "/" . $dt->jenis_produk_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>Edit</a></td>
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
            <h4 class="card-title">Formulir Jenis Produk</h4>
            <form class="forms-sample" method="POST" action="{{ route('jenis_produk-submit',[$jenis_produk_id]) }}">
                @if (!empty($jenis_produk_id))
                    @method('put')
                @endif
                @csrf
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama Jenis Produk</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('nama_jenis_produk') ? 'is-invalid' : ''}}" id="nama_jenis_produk" name="nama_jenis_produk" placeholder="Nama Jenis Produk" value="{{ !empty($jenis_produk_id)?$nama_jenis_produk : old('nama_jenis_produk') }}">
                    {!! $errors->first('nama_jenis_produk', '<p class="help-block">:message</p>') !!}
                    <input type="hidden" class="form-control" id="jenis_produk_id" name="jenis_produk_id" value="{{{ $jenis_produk_id }}}">
                    </div>
                </div>
                
                <div class="float-right">
                    <a href="{{{ route('jenis_produk-list')}}}"><button type="button" class="btn btn-light">Batal</button></a>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                </div>
            </form>
            @if (!empty($jenis_produk_id))
            <div class="float-left">
                <form class="forms-sample" method="POST" action="{{ route('jenis_produk-delete',[$jenis_produk_id]) }}">
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