<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAarshgranthRequest;
use App\Http\Requests\UpdateAarshgranthRequest;
use App\Http\Resources\Admin\AarshgranthResource;
use App\Models\Aarshgranth;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AarshgranthApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('aarshgranth_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AarshgranthResource(Aarshgranth::with(['aarsh_book', 'created_by'])->get());
    }

    public function store(StoreAarshgranthRequest $request)
    {
        $aarshgranth = Aarshgranth::create($request->all());

        return (new AarshgranthResource($aarshgranth))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Aarshgranth $aarshgranth)
    {
        abort_if(Gate::denies('aarshgranth_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AarshgranthResource($aarshgranth->load(['aarsh_book', 'created_by']));
    }

    public function update(UpdateAarshgranthRequest $request, Aarshgranth $aarshgranth)
    {
        $aarshgranth->update($request->all());

        return (new AarshgranthResource($aarshgranth))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Aarshgranth $aarshgranth)
    {
        abort_if(Gate::denies('aarshgranth_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshgranth->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
