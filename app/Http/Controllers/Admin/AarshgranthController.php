<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAarshgranthRequest;
use App\Http\Requests\StoreAarshgranthRequest;
use App\Http\Requests\UpdateAarshgranthRequest;
use App\Models\Aarshbook;
use App\Models\Aarshgranth;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AarshgranthController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('aarshgranth_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Aarshgranth::with(['aarsh_book', 'created_by'])->select(sprintf('%s.*', (new Aarshgranth())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'aarshgranth_show';
                $editGate = 'aarshgranth_edit';
                $deleteGate = 'aarshgranth_delete';
                $crudRoutePart = 'aarshgranths';

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
            $table->addColumn('aarsh_book_aarsh_book', function ($row) {
                return $row->aarsh_book ? $row->aarsh_book->aarsh_book : '';
            });

            $table->editColumn('arshbook_no', function ($row) {
                return $row->arshbook_no ? $row->arshbook_no : '';
            });
            $table->editColumn('arshbook_title', function ($row) {
                return $row->arshbook_title ? $row->arshbook_title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'aarsh_book']);

            return $table->make(true);
        }

        $aarshbooks = Aarshbook::get();
        $users      = User::get();

        return view('admin.aarshgranths.index', compact('aarshbooks', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('aarshgranth_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarsh_books = Aarshbook::all()->pluck('aarsh_book', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.aarshgranths.create', compact('aarsh_books'));
    }

    public function store(StoreAarshgranthRequest $request)
    {
        $aarshgranth = Aarshgranth::create($request->all());

        return redirect()->route('admin.aarshgranths.index');
    }

    public function edit(Aarshgranth $aarshgranth)
    {
        abort_if(Gate::denies('aarshgranth_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarsh_books = Aarshbook::all()->pluck('aarsh_book', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aarshgranth->load('aarsh_book', 'created_by');

        return view('admin.aarshgranths.edit', compact('aarsh_books', 'aarshgranth'));
    }

    public function update(UpdateAarshgranthRequest $request, Aarshgranth $aarshgranth)
    {
        $aarshgranth->update($request->all());

        return redirect()->route('admin.aarshgranths.index');
    }

    public function show(Aarshgranth $aarshgranth)
    {
        abort_if(Gate::denies('aarshgranth_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshgranth->load('aarsh_book', 'created_by', 'granthTitleAarshchapters');

        return view('admin.aarshgranths.show', compact('aarshgranth'));
    }

    public function destroy(Aarshgranth $aarshgranth)
    {
        abort_if(Gate::denies('aarshgranth_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshgranth->delete();

        return back();
    }

    public function massDestroy(MassDestroyAarshgranthRequest $request)
    {
        Aarshgranth::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
