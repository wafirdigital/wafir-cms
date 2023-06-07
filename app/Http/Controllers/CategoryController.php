<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    
     /**
     * @OA\Get(
     * path="/api/v1/categories",
     * operationId="Categories",
     * tags={"Categories"},
     * summary="Get All Categories",
     * description="Get All Categories",
     * security={{ "apiAuth": {} }},
     *     
     *      @OA\Response(
     *          response=201,
     *          description="Categories Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Categories Return Successfully",
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
        return CategoryResource::collection(Category::paginate(10));
    }


    /**
     * @OA\Post(
     * path="/api/v1/categories",
     * operationId="Add New Category",
     * tags={"Categories"},
     * summary="Add New Category",
     * description="Add New Category",
     * security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
    *                required={"name", "description"},
    *                @OA\Property(property="name", type="text", example="Toyota Corolla"),
    *                @OA\Property(property="description", type="text", example="Nice Care"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Category Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Category Created Successfully",
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
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name' =>  $request->name,
            'description' => $request->description,
         ]);
        return new CategoryResource($category);
    }

    /**
     * @OA\Get(
     * path="/api/v1/categories/{id}",
     * operationId="Get Category By Id",
     * tags={"Categories"},
     * summary="Get Category By Id",
     * description="Get Category By Id",
     * security={{ "apiAuth": {} }},
     * @OA\Parameter(
     *    description="Category ID",
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
     *          description="Category Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Category Return Successfully",
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
        $user = Category::findOrFail($id);
        return new CategoryResource($user);
    }


    /**
    * @OA\Put(
    * path="/api/v1/categories/{id}",
    * operationId="Update Bid By ID",
    * tags={"Categories"},
    * summary="Update Category By ID",
    * description="Update Category By ID",
    * security={{ "apiAuth": {} }},
    *        @OA\Parameter(
    *       description="Category ID",
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
    *               @OA\Property(property="name", type="text", example="Toyota Corolla"),
    *               @OA\Property(property="description", type="text", example="Nice Care"),
    *             ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Category By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Category By ID Updated Successfully",
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
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => ($request->name) ? $request->name : $category->name,
            'description' => ($request->description) ? $request->description : $category->description, 
        ]);
        return new CategoryResource($category);
    }


     /**
     * @OA\Delete(
     * path="/api/v1/categories/{id}",
     * operationId="Delete Category By ID",
     * tags={"Categories"},
     * summary="Delete Category By ID",
     * description="Delete Category By ID",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *       description="Category ID",
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
     *          description="Category By ID Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Category By ID Deleted Successfully",
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
        $bid = Category::findOrFail($id);
        if($bid->delete()){
            return response('Bid By ID Deleted Successfully', 200);
        }
    }
}
