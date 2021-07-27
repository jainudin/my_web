@extends('layout.default')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Feature <a class="float-right" href="{{{ URL::route('feature-form') }}}"><button type="button" class="btn btn-sm btn-primary">Tambah</button></a></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Feature Group</th>
                                <th>Nama Feature</th>
                                <th>Feature Url</th>
                                <th>Feature Icon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->feature_group_name }}</td>
                                <td>{{ $dt->feature_name }}</td>
                                <td>{{ $dt->feature_url }}</td>
                                <td>{{ $dt->feature_icon }}</td>
                                <td><a href="<?php echo URL::route('feature-form') . "/" . $dt->feature_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>Edit</a></td>
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