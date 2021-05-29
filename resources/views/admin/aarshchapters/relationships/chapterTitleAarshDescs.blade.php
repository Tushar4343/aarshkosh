<div class="m-3">
    @can('aarsh_desc_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.aarsh-descs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.aarshDesc.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.aarshDesc.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-chapterTitleAarshDescs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.aarshDesc.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.aarshDesc.fields.chapter_title') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aarshDescs as $key => $aarshDesc)
                            <tr data-entry-id="{{ $aarshDesc->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $aarshDesc->id ?? '' }}
                                </td>
                                <td>
                                    {{ $aarshDesc->chapter_title->arshchapter_title ?? '' }}
                                </td>
                                <td>
                                    @can('aarsh_desc_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.aarsh-descs.show', $aarshDesc->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('aarsh_desc_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.aarsh-descs.edit', $aarshDesc->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('aarsh_desc_delete')
                                        <form action="{{ route('admin.aarsh-descs.destroy', $aarshDesc->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('aarsh_desc_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.aarsh-descs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-chapterTitleAarshDescs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection