<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAarshDescRequest;
use App\Http\Requests\StoreAarshDescRequest;
use App\Http\Requests\UpdateAarshDescRequest;
use App\Models\Aarshchapter;
use App\Models\AarshDesc;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AarshDescController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('aarsh_desc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AarshDesc::with(['chapter_title', 'created_by'])->select(sprintf('%s.*', (new AarshDesc())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'aarsh_desc_show';
                $editGate = 'aarsh_desc_edit';
                $deleteGate = 'aarsh_desc_delete';
                $crudRoutePart = 'aarsh-descs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('chapter_title_arshchapter_title', function ($row) {
                return $row->chapter_title ? $row->chapter_title->arshchapter_title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'chapter_title']);

            return $table->make(true);
        }

        $aarshchapters = Aarshchapter::get();
        $users         = User::get();

        return view('admin.aarshDescs.index', compact('aarshchapters', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('aarsh_desc_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapter_titles = Aarshchapter::all()->pluck('arshchapter_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.aarshDescs.create', compact('chapter_titles'));
    }

    public function store(StoreAarshDescRequest $request)
    {
        $aarshDesc = AarshDesc::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $aarshDesc->id]);
        }

        return redirect()->route('admin.aarsh-descs.index');
    }

    public function edit(AarshDesc $aarshDesc)
    {
        abort_if(Gate::denies('aarsh_desc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapter_titles = Aarshchapter::all()->pluck('arshchapter_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aarshDesc->load('chapter_title', 'created_by');

        return view('admin.aarshDescs.edit', compact('chapter_titles', 'aarshDesc'));
    }

    public function update(UpdateAarshDescRequest $request, AarshDesc $aarshDesc)
    {
        $aarshDesc->update($request->all());

        return redirect()->route('admin.aarsh-descs.index');
    }

    public function show(AarshDesc $aarshDesc)
    {
        abort_if(Gate::denies('aarsh_desc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshDesc->load('chapter_title', 'created_by');

        return view('admin.aarshDescs.show', compact('aarshDesc'));
    }

    public function destroy(AarshDesc $aarshDesc)
    {
        abort_if(Gate::denies('aarsh_desc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshDesc->delete();

        return back();
    }

    public function massDestroy(MassDestroyAarshDescRequest $request)
    {
        AarshDesc::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('aarsh_desc_create') && Gate::denies('aarsh_desc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AarshDesc();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
