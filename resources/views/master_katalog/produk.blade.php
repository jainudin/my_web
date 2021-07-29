@extends('layout.default')

@section('content')

@if($function == 'List')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">produk <a class="float-right" href="{{{ URL::route('produk-form') }}}"><button type="button" class="btn btn-sm btn-primary">Tambah</button></a></h4>
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
                                <td>{{ $dt->produk_group_name }}</td>
                                <td>{{ $dt->produk_name }}</td>
                                <td>{{ ($dt->status_jenis_produk ==1 ? 'Aktif' : 'Non-Aktif')  }}</td>
                                <td>{{ $dt->path_gambar_produk }}</td>
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
            <h4 class="card-title">Formulir produk</h4>
            <form class="forms-sample" method="POST" action="{{ route('produk-submit',[$produk_id]) }}">
                @if (!empty($produk_id))
                    @method('put')
                @endif
                @csrf
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">produk group name</label>
                    <div class="col-sm-9">
                        <select name="produk_group_id" id="produk_group_id" class="form-control input-lg">
                            <option value="">Select produk group</option>
                            @foreach ($produk_group as $fg)
                            <option value="{{ $fg->produk_group_id }}" <?php if ($fg->produk_group_id === $produk_group_id) { echo "selected"; }?>>{{ $fg->produk_group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">produk Name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('produk_name') ? 'is-invalid' : ''}}" id="produk_name" name="produk_name" placeholder="produk Name" value="{{{ !empty($produk_group_id)?$produk_name : old('produk_name') }}}">
                    {!! $errors->first('produk_name', '<p class="help-block">:message</p>') !!}
                    <input type="hidden" class="form-control" id="produk_id" name="produk_id" value="{{{ $produk_id }}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">produk Url</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('produk_url') ? 'is-invalid' : ''}}" id="produk_url" name="produk_url" placeholder="produk Url" value="{{{ !empty($produk_group_id)?$produk_url : old('produk_url') }}}">
                    {!! $errors->first('produk_url', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">produk Icon</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('produk_icon') ? 'is-invalid' : ''}}" id="produk_icon" name="produk_icon" placeholder="produk Icon" value="{{{ !empty($produk_group_id)?$produk_icon : old('produk_icon') }}}">
                    {!! $errors->first('produk_icon', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">produk Order</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('produk_order') ? 'is-invalid' : ''}}" id="produk_order" name="produk_order" placeholder="produk Order" value="{{{ !empty($produk_group_id)?$produk_order : old('produk_order') }}}">
                    {!! $errors->first('produk_order', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{{ route('produk-list')}}}"><button type="button" class="btn btn-light">Batal</button></a>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                </div>
            </form>
            @if (!empty($produk_group_id))
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