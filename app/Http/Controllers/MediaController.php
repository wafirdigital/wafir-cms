<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;

class MediaController extends Controller
{
   

    /**
     * @OA\Get(
     * path="/api/v1/media",
     * operationId="Media",
     * tags={"Media"},
     * summary="Get All Media",
     * description="Get All Media",
     * security={{ "apiAuth": {} }},
     *     
     *      @OA\Response(
     *          response=201,
     *          description="Media Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Media Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Media Not Found"),
     * )
     */
    public function index()
    {
        return MediaResource::collection(Media::paginate(10));
    }



    /**
     * @OA\Post(
     * path="/api/v1/media",
     * operationId="Add New Media",
     * tags={"Media"},
     * summary="Add New Media",
     * description="Add New Media",
     * security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"file", "description"},
     *               @OA\Property(property="file", type="file"),
     *               @OA\Property(property="description", type="text", example="lorem ipsum title description"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Media Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Media Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Media Not Found"),
     * )
     */
    public function store(MediaRequest $request)
    {
        $path = '';
        $media = Media::create([
            'path' =>  $path,
            'description' => $request->description,
         ]);
        return new MediaResource($media);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(MediaRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
