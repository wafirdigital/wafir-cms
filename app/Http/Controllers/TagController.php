<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{

    /**
     * @OA\Get(
     * path="/api/v1/tags",
     * operationId="Tags",
     * tags={"Tags"},
     * summary="Get All Tags",
     * description="Get All Tags",
     * security={{ "apiAuth": {} }},
     *     
     *      @OA\Response(
     *          response=201,
     *          description="Tags Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Tags Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Tags Not Found"),
     * )
     */
    public function index()
    {
        return TagResource::collection(Tag::paginate(10));
    }

 
    /**
     * @OA\Post(
     * path="/api/v1/tags",
     * operationId="Add New Tag",
     * tags={"Tags"},
     * summary="Add New Tag",
     * description="Add New Tag",
     * security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *                required={"name"},
     *                @OA\Property(property="name", type="text", example="Apple"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Tag Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Tag Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Tag Not Found"),
     * )
     */
    public function store(TagRequest $request)
    {
        $tag = Tag::create([
            'name' =>  $request->name,
        ]);
        return new TagResource($tag);
    }

    /**
     * @OA\Get(
     * path="/api/v1/tags/{id}",
     * operationId="Get Tag By Id",
     * tags={"Tags"},
     * summary="Get Tag By Id",
     * description="Get Tag By Id",
     * security={{ "apiAuth": {} }},
     * @OA\Parameter(
     *    description="Tag ID",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     *      @OA\Response(
     *          response=201,
     *          description="Tag Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Tag Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Tag Not Found"),
     * )
     */
    public function show(string $id)
    {
        $tag = Tag::findOrFail($id);
        return new TagResource($tag);
    }

    /**
    * @OA\Put(
    * path="/api/v1/tags/{id}",
    * operationId="Update Tag By ID",
    * tags={"Tags"},
    * summary="Update Tag By ID",
    * description="Update Tag By ID",
    * security={{ "apiAuth": {} }},
    *        @OA\Parameter(
    *       description="Tag ID",
    *       in="path",
    *       name="id",
    *       required=true,
    *       example="1",
    *       @OA\Schema(
    *           type="integer",
    *           format="int64"
    *       )
    *   ),
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"name"},
    *               @OA\Property(property="name", type="text", example="Google"),
    *             ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Tag By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Tag By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=422,
    *          description="Unprocessable Entity",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Tag Not Found"),
    * )
    */
    public function update(TagRequest $request, string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update([
            'name' => ($request->name) ? $request->name : $tag->name,
        ]);
        return new TagResource($tag);
    }

    
    /**
     * @OA\Delete(
     * path="/api/v1/tags/{id}",
     * operationId="Delete Tag By ID",
     * tags={"Tags"},
     * summary="Delete Tag By ID",
     * description="Delete Tag By ID",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *       description="Tag ID",
     *       in="path",
     *       name="id",
     *       required=true,
     *       example="1",
     *       @OA\Schema(
     *           type="integer",
     *           format="int64"
     *       )
     *   ),
     *      @OA\Response(
     *          response=201,
     *          description="Tag By ID Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Tag By ID Deleted Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Tag Not Found"),
     * )
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        if($tag->delete()){
            return response('Tag By ID Deleted Successfully', 200);
        }
    }
}
