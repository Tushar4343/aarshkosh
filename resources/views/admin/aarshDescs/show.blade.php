@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aarshDesc.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aarsh-descs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshDesc.fields.id') }}
                        </th>
                        <td>
                            {{ $aarshDesc->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshDesc.fields.chapter_title') }}
                        </th>
                        <td>
                            {{ $aarshDesc->chapter_title->arshchapter_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshDesc.fields.description') }}
                        </th>
                        <td>
                            {!! $aarshDesc->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aarsh-descs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection