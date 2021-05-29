<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAarshchapterRequest;
use App\Http\Requests\UpdateAarshchapterRequest;
use App\Http\Resources\Admin\AarshchapterResource;
use App\Models\Aarshchapter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AarshchapterApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('aarshchapter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AarshchapterResource(Aarshchapter::with(['granth_title', 'created_by'])->get());
    }

    public function store(StoreAarshchapterRequest $request)
    {
        $aarshchapter = Aarshchapter::create($request->all());

        return (new AarshchapterResource($aarshchapter))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Aarshchapter $aarshchapter)
    {
        abort_if(Gate::denies('aarshchapter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AarshchapterResource($aarshchapter->load(['granth_title', 'created_by']));
    }

    public function update(UpdateAarshchapterRequest $request, Aarshchapter $aarshchapter)
    {
        $aarshchapter->update($request->all());

        return (new AarshchapterResource($aarshchapter))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Aarshchapter $aarshchapter)
    {
        abort_if(Gate::denies('aarshchapter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshchapter->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
