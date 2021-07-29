@extends('layout.default')

@section('content')

@if($function == 'List')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profil Perusahaan <a class="float-right" href="{{{ URL::route('profil_perusahaan-form') }}}"><button type="button" class="btn btn-sm btn-primary">Tambah</button></a></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Perusahaan</th>
                                <th>Alamat Perusahaan</th>
                                <th>Website Perusahaan</th>
                                <th>e-mail Perusahaan</th>
                                <th>Status Perusahaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->nama_perusahaan }}</td>
                                <td>{{ $dt->alamat_perusahaan }}</td>
                                <td>{{ $dt->website_perusahaan }}</td>
                                <td>{{ $dt->email_perusahaan }}</td>
                                <td>{{ ($dt->status ==1 ? 'Aktif' : 'Non-Aktif')  }}</td>
                                <td><a href="<?php echo URL::route('profil_perusahaan-form') . "/" . $dt->profil_perusahaan_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>Edit</a></td>
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
            <h4 class="card-title">Formulir Profil Perusahaan</h4>
            <form class="forms-sample" method="POST" action="{{ route('profil_perusahaan-submit',[$profil_perusahaan_id]) }}">
                @if (!empty($profil_perusahaan_id))
                    @method('put')
                @endif
                @csrf
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama Perusahaan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('nama_perusahaan') ? 'is-invalid' : ''}}" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan" value="{{{ !empty($profil_perusahaan_id)?$nama_perusahaan : old('nama_perusahaan') }}}">
                    {!! $errors->first('nama_perusahaan', '<p class="help-block">:message</p>') !!}
                    <input type="hidden" class="form-control" id="profil_perusahaan_id" name="profil_perusahaan_id" value="{{{ $profil_perusahaan_id }}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Alamat Perusahaan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('alamat_perusahaan') ? 'is-invalid' : ''}}" id="alamat_perusahaan" name="alamat_perusahaan" placeholder="Alamat Perusahaan" value="{{{ !empty($profil_perusahaan_id)?$alamat_perusahaan : old('alamat_perusahaan') }}}">
                    {!! $errors->first('alamat_perusahaan', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Foto Perusahaan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('path_foto_perusahaan') ? 'is-invalid' : ''}}" id="path_foto_perusahaan" name="path_foto_perusahaan" placeholder="Foto Perusahaan" value="{{{ !empty($profil_perusahaan_id)?$path_foto_perusahaan : old('path_foto_perusahaan') }}}">
                    {!! $errors->first('path_foto_perusahaan', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Logo Perusahaan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('path_logo_perusahaan') ? 'is-invalid' : ''}}" id="path_logo_perusahaan" name="path_logo_perusahaan" placeholder="Logo Perusahaan" value="{{{ !empty($profil_perusahaan_id)?$path_logo_perusahaan : old('path_logo_perusahaan') }}}">
                    {!! $errors->first('path_logo_perusahaan', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Website Perusahaan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('website_perusahaan') ? 'is-invalid' : ''}}" id="website_perusahaan" name="website_perusahaan" placeholder="Website Perusahaan" value="{{{ !empty($profil_perusahaan_id)?$website_perusahaan : old('website_perusahaan') }}}">
                    {!! $errors->first('website_perusahaan', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email Perusahaan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('email_perusahaan') ? 'is-invalid' : ''}}" id="email_perusahaan" name="email_perusahaan" placeholder="Email Perusahaan" value="{{{ !empty($profil_perusahaan_id)?$email_perusahaan : old('email_perusahaan') }}}">
                    {!! $errors->first('email_perusahaan', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Tentang Perusahaan</label>
                    <div class="col-sm-9">
                        <textarea  rows="3"class="form-control {{ $errors->has('tentang_perusahaan') ? 'is-invalid' : ''}}" id="tentang_perusahaan" name="tentang_perusahaan" placeholder="Tentang Perusahaan" value="{{{ !empty($profil_perusahaan_id)?$tentang_perusahaan : old('tentang_perusahaan') }}}"></textarea>
                    {!! $errors->first('tentang_perusahaan', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{{ route('profil_perusahaan-list')}}}"><button type="button" class="btn btn-light">Batal</button></a>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                </div>
            </form>
            @if (!empty($profil_perusahaan_id))
            <div class="float-left">
                <form class="forms-sample" method="POST" action="{{ route('profil_perusahaan-delete',[$profil_perusahaan_id]) }}">
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