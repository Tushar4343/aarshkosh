@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.aarshgranth.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.aarshgranths.update", [$aarshgranth->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="aarsh_book_id">{{ trans('cruds.aarshgranth.fields.aarsh_book') }}</label>
                <select class="form-control select2 {{ $errors->has('aarsh_book') ? 'is-invalid' : '' }}" name="aarsh_book_id" id="aarsh_book_id" required>
                    @foreach($aarsh_books as $id => $entry)
                        <option value="{{ $id }}" {{ (old('aarsh_book_id') ? old('aarsh_book_id') : $aarshgranth->aarsh_book->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('aarsh_book'))
                    <span class="text-danger">{{ $errors->first('aarsh_book') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aarshgranth.fields.aarsh_book_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="arshbook_no">{{ trans('cruds.aarshgranth.fields.arshbook_no') }}</label>
                <input class="form-control {{ $errors->has('arshbook_no') ? 'is-invalid' : '' }}" type="number" name="arshbook_no" id="arshbook_no" value="{{ old('arshbook_no', $aarshgranth->arshbook_no) }}" step="1" required>
                @if($errors->has('arshbook_no'))
                    <span class="text-danger">{{ $errors->first('arshbook_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aarshgranth.fields.arshbook_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="arshbook_title">{{ trans('cruds.aarshgranth.fields.arshbook_title') }}</label>
                <input class="form-control {{ $errors->has('arshbook_title') ? 'is-invalid' : '' }}" type="text" name="arshbook_title" id="arshbook_title" value="{{ old('arshbook_title', $aarshgranth->arshbook_title) }}" required>
                @if($errors->has('arshbook_title'))
                    <span class="text-danger">{{ $errors->first('arshbook_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aarshgranth.fields.arshbook_title_helper') }}</span>
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