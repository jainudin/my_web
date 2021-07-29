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
                                <th>Status Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->nama_kategori }}</td>
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
            <form class="forms-sample" method="POST" action="{{ route('kategori-submit',[$kategori_id]) }}">
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