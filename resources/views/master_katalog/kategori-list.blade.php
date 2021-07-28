@extends('layout.default')

@section('content')
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
                            @
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
@stop