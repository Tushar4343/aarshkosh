@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aarshchapter.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aarshchapters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshchapter.fields.id') }}
                        </th>
                        <td>
                            {{ $aarshchapter->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshchapter.fields.granth_title') }}
                        </th>
                        <td>
                            {{ $aarshchapter->granth_title->arshbook_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshchapter.fields.arshchapter_no') }}
                        </th>
                        <td>
                            {{ $aarshchapter->arshchapter_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshchapter.fields.arshchapter_title') }}
                        </th>
                        <td>
                            {{ $aarshchapter->arshchapter_title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aarshchapters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#chapter_title_aarsh_descs" role="tab" data-toggle="tab">
                {{ trans('cruds.aarshDesc.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="chapter_title_aarsh_descs">
            @includeIf('admin.aarshchapters.relationships.chapterTitleAarshDescs', ['aarshDescs' => $aarshchapter->chapterTitleAarshDescs])
        </div>
    </div>
</div>

@endsection