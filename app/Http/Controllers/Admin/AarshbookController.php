<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAarshbookRequest;
use App\Http\Requests\StoreAarshbookRequest;
use App\Http\Requests\UpdateAarshbookRequest;
use App\Models\Aarshbook;
use App\Models\Language;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AarshbookController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('aarshbook_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Aarshbook::with(['language', 'created_by'])->select(sprintf('%s.*', (new Aarshbook())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'aarshbook_show';
                $editGate = 'aarshbook_edit';
                $deleteGate = 'aarshbook_delete';
                $crudRoutePart = 'aarshbooks';

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
            $table->addColumn('language_name', function ($row) {
                return $row->language ? $row->language->name : '';
            });

            $table->editColumn('aarsh_book', function ($row) {
                return $row->aarsh_book ? $row->aarsh_book : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'language']);

            return $table->make(true);
        }

        $languages = Language::get();
        $users     = User::get();

        return view('admin.aarshbooks.index', compact('languages', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('aarshbook_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.aarshbooks.create', compact('languages'));
    }

    public function store(StoreAarshbookRequest $request)
    {
        $aarshbook = Aarshbook::create($request->all());

        return redirect()->route('admin.aarshbooks.index');
    }

    public function edit(Aarshbook $aarshbook)
    {
        abort_if(Gate::denies('aarshbook_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aarshbook->load('language', 'created_by');

        return view('admin.aarshbooks.edit', compact('languages', 'aarshbook'));
    }

    public function update(UpdateAarshbookRequest $request, Aarshbook $aarshbook)
    {
        $aarshbook->update($request->all());

        return redirect()->route('admin.aarshbooks.index');
    }

    public function show(Aarshbook $aarshbook)
    {
        abort_if(Gate::denies('aarshbook_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshbook->load('language', 'created_by', 'aarshBookAarshgranths');

        return view('admin.aarshbooks.show', compact('aarshbook'));
    }

    public function destroy(Aarshbook $aarshbook)
    {
        abort_if(Gate::denies('aarshbook_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshbook->delete();

        return back();
    }

    public function massDestroy(MassDestroyAarshbookRequest $request)
    {
        Aarshbook::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
