<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAarshbookRequest;
use App\Http\Requests\UpdateAarshbookRequest;
use App\Http\Resources\Admin\AarshbookResource;
use App\Models\Aarshbook;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AarshbookApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('aarshbook_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AarshbookResource(Aarshbook::with(['language', 'created_by'])->get());
    }

    public function store(StoreAarshbookRequest $request)
    {
        $aarshbook = Aarshbook::create($request->all());

        return (new AarshbookResource($aarshbook))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Aarshbook $aarshbook)
    {
        abort_if(Gate::denies('aarshbook_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AarshbookResource($aarshbook->load(['language', 'created_by']));
    }

    public function update(UpdateAarshbookRequest $request, Aarshbook $aarshbook)
    {
        $aarshbook->update($request->all());

        return (new AarshbookResource($aarshbook))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Aarshbook $aarshbook)
    {
        abort_if(Gate::denies('aarshbook_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshbook->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
