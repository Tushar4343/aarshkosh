<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAarshchapterRequest;
use App\Http\Requests\StoreAarshchapterRequest;
use App\Http\Requests\UpdateAarshchapterRequest;
use App\Models\Aarshchapter;
use App\Models\Aarshgranth;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AarshchapterController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('aarshchapter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Aarshchapter::with(['granth_title', 'created_by'])->select(sprintf('%s.*', (new Aarshchapter())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'aarshchapter_show';
                $editGate = 'aarshchapter_edit';
                $deleteGate = 'aarshchapter_delete';
                $crudRoutePart = 'aarshchapters';

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
            $table->addColumn('granth_title_arshbook_title', function ($row) {
                return $row->granth_title ? $row->granth_title->arshbook_title : '';
            });

            $table->editColumn('arshchapter_no', function ($row) {
                return $row->arshchapter_no ? $row->arshchapter_no : '';
            });
            $table->editColumn('arshchapter_title', function ($row) {
                return $row->arshchapter_title ? $row->arshchapter_title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'granth_title']);

            return $table->make(true);
        }

        $aarshgranths = Aarshgranth::get();
        $users        = User::get();

        return view('admin.aarshchapters.index', compact('aarshgranths', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('aarshchapter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $granth_titles = Aarshgranth::all()->pluck('arshbook_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.aarshchapters.create', compact('granth_titles'));
    }

    public function store(StoreAarshchapterRequest $request)
    {
        $aarshchapter = Aarshchapter::create($request->all());

        return redirect()->route('admin.aarshchapters.index');
    }

    public function edit(Aarshchapter $aarshchapter)
    {
        abort_if(Gate::denies('aarshchapter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $granth_titles = Aarshgranth::all()->pluck('arshbook_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aarshchapter->load('granth_title', 'created_by');

        return view('admin.aarshchapters.edit', compact('granth_titles', 'aarshchapter'));
    }

    public function update(UpdateAarshchapterRequest $request, Aarshchapter $aarshchapter)
    {
        $aarshchapter->update($request->all());

        return redirect()->route('admin.aarshchapters.index');
    }

    public function show(Aarshchapter $aarshchapter)
    {
        abort_if(Gate::denies('aarshchapter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshchapter->load('granth_title', 'created_by', 'chapterTitleAarshDescs');

        return view('admin.aarshchapters.show', compact('aarshchapter'));
    }

    public function destroy(Aarshchapter $aarshchapter)
    {
        abort_if(Gate::denies('aarshchapter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshchapter->delete();

        return back();
    }

    public function massDestroy(MassDestroyAarshchapterRequest $request)
    {
        Aarshchapter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
