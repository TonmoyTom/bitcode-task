<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortCreateRequest;
use App\Http\Requests\ShortUpdateRequest;
use App\Http\Resources\ShortLinkResource;
use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Throwable;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            DB::beginTransaction();
            $shortLinks = ShortLink::all();
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->apiResponse('404', "Not Found");
        }
        return $this->apiResponse('202', "ALl Short link" , $shortLinks);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $request) : JsonResponse
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShortCreateRequest $request) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $link = ShortLink::createNew($request->validated());
            $response_data['link'] = new ShortLinkResource($link);
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();

            return $this->apiResponse('404', "Not Found");
        }
        return $this->apiResponse('202', "Link Store" , $response_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id):JsonResponse
    {
        try {
            DB::beginTransaction();
            $response_data = ShortLink::findOrFail($id);
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->apiResponse('404', "Not Found");
        }
        return $this->apiResponse('202', "Link Show" , new ShortLinkResource($response_data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortLink $shortLink)
    {
        try {
            DB::beginTransaction();
            $response_data['link'] = new ShortLinkResource($shortLink);
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->apiResponse('404', "Not Found");
        }
        return $this->apiResponse('202', "Link Store" , $response_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShortUpdateRequest $request , $id) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $link = ShortLink::findOrFail($id);
            $link->updateData(
                $request->only(['link'])
            );
            $response_data['link'] = new ShortLinkResource($link);
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->apiResponse('404', "Not Found");
        }
        return $this->apiResponse('202', "Link Update" , $response_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) :JsonResponse
    {
        try {
            DB::beginTransaction();
            $response_data['link'] = ShortLink::findOrFail($id)->delete();
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->apiResponse('404', "Not Found");
        }
        return $this->apiResponse('202', "Link Delete Successfull");
    }

    public function link($code):JsonResponse
    {
        try {
            DB::beginTransaction();
            $find = ShortLink::where('code', $code)->first();
            $data = new ShortLinkResource($find);
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->apiResponse('404', "Link Not Found");
        }
        return $this->apiResponse('202','Found This Link',  $data);

    }



}
