@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.aarshchapter.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.aarshchapters.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="granth_title_id">{{ trans('cruds.aarshchapter.fields.granth_title') }}</label>
                <select class="form-control select2 {{ $errors->has('granth_title') ? 'is-invalid' : '' }}" name="granth_title_id" id="granth_title_id" required>
                    @foreach($granth_titles as $id => $entry)
                        <option value="{{ $id }}" {{ old('granth_title_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('granth_title'))
                    <span class="text-danger">{{ $errors->first('granth_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aarshchapter.fields.granth_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="arshchapter_no">{{ trans('cruds.aarshchapter.fields.arshchapter_no') }}</label>
                <input class="form-control {{ $errors->has('arshchapter_no') ? 'is-invalid' : '' }}" type="number" name="arshchapter_no" id="arshchapter_no" value="{{ old('arshchapter_no', '') }}" step="1" required>
                @if($errors->has('arshchapter_no'))
                    <span class="text-danger">{{ $errors->first('arshchapter_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aarshchapter.fields.arshchapter_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="arshchapter_title">{{ trans('cruds.aarshchapter.fields.arshchapter_title') }}</label>
                <input class="form-control {{ $errors->has('arshchapter_title') ? 'is-invalid' : '' }}" type="text" name="arshchapter_title" id="arshchapter_title" value="{{ old('arshchapter_title', '') }}" required>
                @if($errors->has('arshchapter_title'))
                    <span class="text-danger">{{ $errors->first('arshchapter_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aarshchapter.fields.arshchapter_title_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection