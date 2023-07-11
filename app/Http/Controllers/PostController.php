<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    
    /**
     * @OA\Get(
     * path="/api/v1/posts",
     * operationId="Posts",
     * tags={"Posts"},
     * summary="Get All Posts",
     * description="Get All Posts",
     * security={{ "apiAuth": {} }},
     *     
     *      @OA\Response(
     *          response=201,
     *          description="Posts Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Posts Return Successfully",
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
    public function index()
    {
        return PostResource::collection(Post::paginate(10));
    }
    
    /**
     * @OA\Post(
     * path="/api/v1/posts",
     * operationId="Add New Post",
     * tags={"Posts"},
     * summary="Add New Post",
     * description="Add New Post",
     * security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"title", "description", "source"},
     *               @OA\Property(property="title", type="text", example="lorem ipsum title"),
     *               @OA\Property(property="description", type="text", example="lorem ipsum title description"),
     *               @OA\Property(property="source", type="text", example="https://en.wikipedia.org/wiki/Trade_dollar_(United_States_coin)"),
     * 
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Post Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Post Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Post Not Found"),
     * )
     */
    public function store(PostRequest $request)
    {
        $post= Post::create([
            'title' =>  $request->title,
            'description' => $request->description,
         ]);
        return new PostResource($post);
    }

    /**
     * @OA\Get(
     * path="/api/v1/posts/{id}",
     * operationId="Get Post By Id",
     * tags={"Posts"},
     * summary="Get Post By Id",
     * description="Get Post By Id",
     * security={{ "apiAuth": {} }},
     * @OA\Parameter(
     *    description="Post ID",
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
     *          description="Post Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Post Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Exercise Not Found"),
     * )
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return new PostResource($post);
    }

    
    /**
    * @OA\Put(
    * path="/api/v1/posts/{id}",
    * operationId="Update Post By ID",
    * tags={"Posts"},
    * summary="Update Post By ID",
    * description="Update Post By ID",
    * security={{ "apiAuth": {} }},
    *        @OA\Parameter(
    *       description="Post ID",
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
    *               required={"title", "description", "status", "source"},
    *               @OA\Property(property="title", type="text", example="I Phone 14"),
    *               @OA\Property(property="description", type="text", example="Nice Phone"),
    *               @OA\Property(property="source", type="text", example="https://en.wikipedia.org/wiki/Trade_dollar_(United_States_coin)"),
    *               @OA\Property(property="status", type="text", example="active"),
    *             ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Post By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Post By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=422,
    *          description="Unprocessable Entity",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Post Not Found"),
    * )
    */
    public function update(PostRequest $request, string $id)
    {
     
        $post = Post::findOrFail($id);
        $post->update([
           'title' => ($request->title) ? $request->title : $post->title,
           'description' => ($request->description) ? $request->description : $post->description,
           'status' => ($request->status) ? $request->status : $post->status,
        ]);
        return new PostResource($post);
    }

    
    /**
     * @OA\Delete(
     * path="/api/v1/posts/{id}",
     * operationId="Delete Post By ID",
     * tags={"Posts"},
     * summary="Delete Post By ID",
     * description="Delete Post By ID",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *       description="Post ID",
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
     *          description="Post By ID Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Post By ID Deleted Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="User By ID Not Found"),
     * )
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        if($post->delete()){
            return response('Post By ID Deleted Successfully', 200);
        }
    }
}
