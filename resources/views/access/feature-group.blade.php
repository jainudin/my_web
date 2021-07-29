@extends('layout.default')

@section('content')

@if($function == 'List')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Feature Group <a class="float-right" href="{{{ URL::route('feature-group-form') }}}"><button type="button" class="btn btn-sm btn-primary">Tambah</button></a></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Feature Group</th>
                                <th>Feature Group Order</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->feature_group_name }}</td>
                                <td>{{ $dt->feature_group_order }}</td>
                                <td><a href="<?php echo URL::route('feature-group-form') . "/" . $dt->feature_group_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>Edit</a></td>
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
            <h4 class="card-title">Formulir Feature Group</h4>
            <form class="forms-sample" method="POST" action="{{ route('feature-group-submit',[$feature_group_id]) }}">
                @if (!empty($feature_group_id))
                    @method('put')
                @endif
                @csrf
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Feature group name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('feature_group_name') ? 'is-invalid' : ''}}" id="feature-group_name" name="feature_group_name" placeholder="Feature group name" value="{{ !empty($feature_group_id)?$feature_group_name : old('feature_group_name') }}">
                    {!! $errors->first('feature_group_name', '<p class="help-block">:message</p>') !!}
                    <input type="hidden" class="form-control" id="feature-group_id" name="feature_group_id" value="{{{ $feature_group_id }}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Feature group Order</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('feature_group_order') ? 'is-invalid' : ''}}" id="feature-group_name" name="feature_group_order" placeholder="Feature group Order" value="{{{ !empty($feature_group_id)?$feature_group_order : old('feature_group_order') }}}">
                    {!! $errors->first('feature_group_order', '<p class="help-block">:message</p>') !!}
                </div>
                </div>
                <div class="float-right">
                    <a href="{{{ route('feature-group-list')}}}"><button type="button" class="btn btn-light">Batal</button></a>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                </div>
            </form>
            @if (!empty($feature_group_id))
            <div class="float-left">
                <form class="forms-sample" method="POST" action="{{ route('feature-group-delete',[$feature_group_id]) }}">
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