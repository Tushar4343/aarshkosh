@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.aarshbook.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.aarshbooks.update", [$aarshbook->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="language_id">{{ trans('cruds.aarshbook.fields.language') }}</label>
                <select class="form-control select2 {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language_id" id="language_id" required>
                    @foreach($languages as $id => $entry)
                        <option value="{{ $id }}" {{ (old('language_id') ? old('language_id') : $aarshbook->language->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('language'))
                    <span class="text-danger">{{ $errors->first('language') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aarshbook.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="aarsh_book">{{ trans('cruds.aarshbook.fields.aarsh_book') }}</label>
                <input class="form-control {{ $errors->has('aarsh_book') ? 'is-invalid' : '' }}" type="text" name="aarsh_book" id="aarsh_book" value="{{ old('aarsh_book', $aarshbook->aarsh_book) }}" required>
                @if($errors->has('aarsh_book'))
                    <span class="text-danger">{{ $errors->first('aarsh_book') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aarshbook.fields.aarsh_book_helper') }}</span>
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