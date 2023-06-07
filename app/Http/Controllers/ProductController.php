<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    
    /**
     * @OA\Get(
     * path="/api/v1/products",
     * operationId="Products",
     * tags={"Products"},
     * summary="Get All Products",
     * description="Get All Products",
     * security={{ "apiAuth": {} }},
     *     
     *      @OA\Response(
     *          response=201,
     *          description="Products Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Products Return Successfully",
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
        return ProductResource::collection(Product::paginate(10));
    }
    
    /**
     * @OA\Post(
     * path="/api/v1/products",
     * operationId="Add New Product",
     * tags={"Products"},
     * summary="Add New Product",
     * description="Add New Product",
     * security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name", "description", "price"},
     *               @OA\Property(property="name", type="text", example="I Phone 14"),
     *               @OA\Property(property="description", type="text", example="Nice Phone"),
     *               @OA\Property(property="price", type="decemal", example="700.5"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Product Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Product Created Successfully",
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
    public function store(ProductRequest $request)
    {
        $product= Product::create([
            'name' =>  $request->name,
            'description' => $request->description,
            'price' => $request->price,
         ]);
        return new ProductResource($product);
    }

    /**
     * @OA\Get(
     * path="/api/v1/products/{id}",
     * operationId="Get Product By Id",
     * tags={"Products"},
     * summary="Get Product By Id",
     * description="Get Product By Id",
     * security={{ "apiAuth": {} }},
     * @OA\Parameter(
     *    description="Product ID",
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
     *          description="Product Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Product Return Successfully",
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
        $user = Product::findOrFail($id);
        return new ProductResource($user);
    }

    
    /**
    * @OA\Put(
    * path="/api/v1/products/{id}",
    * operationId="Update Product By ID",
    * tags={"Products"},
    * summary="Update Product By ID",
    * description="Update Product By ID",
    * security={{ "apiAuth": {} }},
    *        @OA\Parameter(
    *       description="Product ID",
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
    *               required={"name", "description", "price"},
    *               @OA\Property(property="name", type="text", example="I Phone 14"),
    *               @OA\Property(property="description", type="text", example="Nice Phone"),
    *               @OA\Property(property="price", type="decemal", example="700.5"),
    *             ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Product By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Product By ID Updated Successfully",
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
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update([
           'name' => ($request->name) ? $request->name : $product->name,
           'description' => ($request->description) ? $request->description : $product->description,
           'price' => ($request->price) ? $request->price : $product->price,
        ]);
        return new ProductResource($product);
    }

    
    /**
     * @OA\Delete(
     * path="/api/v1/products/{id}",
     * operationId="Delete Product By ID",
     * tags={"Products"},
     * summary="Delete Product By ID",
     * description="Delete Product By ID",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *       description="Product ID",
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
     *          description="Product By ID Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Product By ID Deleted Successfully",
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
        $product = Product::findOrFail($id);
        if($product->delete()){
            return response('Product By ID Deleted Successfully', 200);
        }
    }
}
