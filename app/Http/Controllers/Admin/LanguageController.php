<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLanguageRequest;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LanguageController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('language_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Language::with(['created_by'])->select(sprintf('%s.*', (new Language())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'language_show';
                $editGate = 'language_edit';
                $deleteGate = 'language_delete';
                $crudRoutePart = 'languages';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.languages.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('language_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.languages.create');
    }

    public function store(StoreLanguageRequest $request)
    {
        $language = Language::create($request->all());

        return redirect()->route('admin.languages.index');
    }

    public function edit(Language $language)
    {
        abort_if(Gate::denies('language_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $language->load('created_by');

        return view('admin.languages.edit', compact('language'));
    }

    public function update(UpdateLanguageRequest $request, Language $language)
    {
        $language->update($request->all());

        return redirect()->route('admin.languages.index');
    }

    public function show(Language $language)
    {
        abort_if(Gate::denies('language_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $language->load('created_by', 'languageAarshbooks');

        return view('admin.languages.show', compact('language'));
    }

    public function destroy(Language $language)
    {
        abort_if(Gate::denies('language_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $language->delete();

        return back();
    }

    public function massDestroy(MassDestroyLanguageRequest $request)
    {
        Language::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
