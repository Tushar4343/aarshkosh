<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAarshDescRequest;
use App\Http\Requests\UpdateAarshDescRequest;
use App\Http\Resources\Admin\AarshDescResource;
use App\Models\AarshDesc;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AarshDescApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('aarsh_desc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AarshDescResource(AarshDesc::with(['chapter_title', 'created_by'])->get());
    }

    public function store(StoreAarshDescRequest $request)
    {
        $aarshDesc = AarshDesc::create($request->all());

        return (new AarshDescResource($aarshDesc))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AarshDesc $aarshDesc)
    {
        abort_if(Gate::denies('aarsh_desc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AarshDescResource($aarshDesc->load(['chapter_title', 'created_by']));
    }

    public function update(UpdateAarshDescRequest $request, AarshDesc $aarshDesc)
    {
        $aarshDesc->update($request->all());

        return (new AarshDescResource($aarshDesc))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AarshDesc $aarshDesc)
    {
        abort_if(Gate::denies('aarsh_desc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aarshDesc->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
