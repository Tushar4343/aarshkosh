@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aarshgranth.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aarshgranths.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshgranth.fields.id') }}
                        </th>
                        <td>
                            {{ $aarshgranth->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshgranth.fields.aarsh_book') }}
                        </th>
                        <td>
                            {{ $aarshgranth->aarsh_book->aarsh_book ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshgranth.fields.arshbook_no') }}
                        </th>
                        <td>
                            {{ $aarshgranth->arshbook_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshgranth.fields.arshbook_title') }}
                        </th>
                        <td>
                            {{ $aarshgranth->arshbook_title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aarshgranths.index') }}">
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
            <a class="nav-link" href="#granth_title_aarshchapters" role="tab" data-toggle="tab">
                {{ trans('cruds.aarshchapter.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="granth_title_aarshchapters">
            @includeIf('admin.aarshgranths.relationships.granthTitleAarshchapters', ['aarshchapters' => $aarshgranth->granthTitleAarshchapters])
        </div>
    </div>
</div>

@endsection