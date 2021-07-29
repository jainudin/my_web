
@extends('layout.default')

@section('content')
<div class="row">
    <div class="col-12 stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Formulir Feature</h4>
            <form class="forms-sample" method="POST" action="{{ route('feature-submit',[$feature_id]) }}">
                @if (!empty($feature_id))
                    @method('put')
                @endif
                @csrf
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Feature group name</label>
                    <div class="col-sm-9">
                        <select name="feature_group_id" id="feature_group_id" class="form-control input-lg">
                            <option value="">Select Feature group</option>
                            @foreach ($feature_group as $fg)
                            <option value="{{ $fg->feature_group_id }}" <?php if ($fg->feature_group_id === $feature_group_id) { echo "selected"; }?>>{{ $fg->feature_group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Feature Name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('feature_name') ? 'is-invalid' : ''}}" id="ffeature_name" name="feature_name" placeholder="Feature Name" value="{{{ !empty($feature_group_id)?$feature_name : old('feature_name') }}}">
                    {!! $errors->first('feature_name', '<p class="help-block">:message</p>') !!}
                    <input type="hidden" class="form-control" id="feature_id" name="feature_id" value="{{{ $feature_id }}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Feature Url</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('feature_url') ? 'is-invalid' : ''}}" id="feature_url" name="feature_url" placeholder="Feature Url" value="{{{ !empty($feature_group_id)?$feature_url : old('feature_url') }}}">
                    {!! $errors->first('feature_url', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Feature Icon</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('feature_icon') ? 'is-invalid' : ''}}" id="feature_icon" name="feature_icon" placeholder="Feature Icon" value="{{{ !empty($feature_group_id)?$feature_icon : old('feature_icon') }}}">
                    {!! $errors->first('feature_icon', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Feature Order</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('feature_order') ? 'is-invalid' : ''}}" id="feature_order" name="feature_order" placeholder="Feature Order" value="{{{ !empty($feature_group_id)?$feature_order : old('feature_order') }}}">
                    {!! $errors->first('feature_order', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{{ route('feature-list')}}}"><button type="button" class="btn btn-light">Batal</button></a>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                </div>
            </form>
            @if (!empty($feature_group_id))
            <div class="float-left">
                <form class="forms-sample" method="POST" action="{{ route('feature-delete',[$feature_id]) }}">
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
@stop

@section('css-page')
@stop

@section('js-page')
    <script>
    $(document).ready(function(){
        $('.dynamic').change(function(){
            
            if($(this).val() != '')
            {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
             //alert(select + "_" + value + "_" + dependent);
            $.ajax({
                url:"{{ route('dynamic-dropdown')}}",
                method:"POST",
                data:{select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    $('#'+dependent+'_id').html(result);
                }

            })
            }
        });
        $('#provinced_id').change(function(){
            $('#city_id').val('');
        });
        $(function () {
            $('.btn-del').on('click', function () {
                return confirm('Hapus data ini?');
            });
        });
    });
    </script>
@stop