<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;

class TopicController extends Controller
{
    
     /**
     * @OA\Get(
     * path="/api/v1/topics",
     * operationId="Topics",
     * tags={"Topics"},
     * summary="Get All Topics",
     * description="Get All Topics",
     * security={{ "apiAuth": {} }},
     *     
     *      @OA\Response(
     *          response=201,
     *          description="Topics Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Topics Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Topics Not Found"),
     * )
     */
    public function index()
    {
        return TopicResource::collection(Topic::paginate(10));
    }


    /**
     * @OA\Post(
     * path="/api/v1/topics",
     * operationId="Add New Topic",
     * tags={"Topics"},
     * summary="Add New Topic",
     * description="Add New Topic",
     * security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *                required={"name", "description"},
     *                @OA\Property(property="name", type="text", example="Technology"),
     *                @OA\Property(property="description", type="text", example="Technology Topic"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Topic Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Topic Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(TopicRequest $request)
    {
        $category = Topic::create([
            'name' =>  $request->name,
            'description' => $request->description,
         ]);
        return new TopicResource($category);
    }

    /**
     * @OA\Get(
     * path="/api/v1/topics/{id}",
     * operationId="Get Topic By Id",
     * tags={"Topics"},
     * summary="Get Topic By Id",
     * description="Get Topic By Id",
     * security={{ "apiAuth": {} }},
     * @OA\Parameter(
     *    description="Topic ID",
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
     *          description="Topic Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Topic Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Topic Not Found"),
     * )
     */
    public function show(string $id)
    {
        $user = Topic::findOrFail($id);
        return new TopicResource($user);
    }


    /**
    * @OA\Put(
    * path="/api/v1/topics/{id}",
    * operationId="Update Topic By ID",
    * tags={"Topics"},
    * summary="Update Topic By ID",
    * description="Update Topic By ID",
    * security={{ "apiAuth": {} }},
    *        @OA\Parameter(
    *       description="Topic ID",
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
    *               required={"name", "description"},
    *               @OA\Property(property="name", type="text", example="Money"),
    *               @OA\Property(property="description", type="text", example="Money Topic"),
    *             ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Topic By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Topic By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=422,
    *          description="Unprocessable Entity",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Topic Not Found"),
    * )
    */
    public function update(TopicRequest $request, string $id)
    {
        $category = Topic::findOrFail($id);
        $category->update([
            'name' => ($request->name) ? $request->name : $category->name,
            'description' => ($request->description) ? $request->description : $category->description, 
        ]);
        return new TopicResource($category);
    }


     /**
     * @OA\Delete(
     * path="/api/v1/topics/{id}",
     * operationId="Delete Topic By ID",
     * tags={"Topics"},
     * summary="Delete Topic By ID",
     * description="Delete Topic By ID",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *       description="Topic ID",
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
     *          description="Topic By ID Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Topic By ID Deleted Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Topic By ID Not Found"),
     * )
     */
    public function destroy(string $id)
    {
        $category = Topic::findOrFail($id);
        if($category->delete()){
            return response('Topic By ID Deleted Successfully', 200);
        }
    }
}
