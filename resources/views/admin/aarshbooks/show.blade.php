@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aarshbook.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aarshbooks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshbook.fields.id') }}
                        </th>
                        <td>
                            {{ $aarshbook->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshbook.fields.language') }}
                        </th>
                        <td>
                            {{ $aarshbook->language->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aarshbook.fields.aarsh_book') }}
                        </th>
                        <td>
                            {{ $aarshbook->aarsh_book }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aarshbooks.index') }}">
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
            <a class="nav-link" href="#aarsh_book_aarshgranths" role="tab" data-toggle="tab">
                {{ trans('cruds.aarshgranth.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="aarsh_book_aarshgranths">
            @includeIf('admin.aarshbooks.relationships.aarshBookAarshgranths', ['aarshgranths' => $aarshbook->aarshBookAarshgranths])
        </div>
    </div>
</div>

@endsection