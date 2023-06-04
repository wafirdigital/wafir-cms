<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Http\Resources\BidResource;
use App\Models\Bid;

class BidController extends Controller
{
    

     /**
     * @OA\Get(
     * path="/api/v1/bids",
     * operationId="Bids",
     * tags={"Bids"},
     * summary="Get All Bids",
     * description="Get All Bids",
     * security={{ "apiAuth": {} }},
     *     
     *      @OA\Response(
     *          response=201,
     *          description="Bids Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Bids Return Successfully",
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
        return BidResource::collection(Bid::paginate(10));
    }


    /**
     * @OA\Post(
     * path="/api/v1/bids",
     * operationId="Add New Bid",
     * tags={"Bids"},
     * summary="Add New Bid",
     * description="Add New Bid",
     * security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"product_id", "new_price"},
     *               @OA\Property(property="product_id", type="integer", example="1"),
     *               @OA\Property(property="new_price", type="integer", example="500"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Bid Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Bid Created Successfully",
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
    public function store(BidRequest $request)
    {
        $bid = Bid::create([
            'product_id' =>  $request->product_id,
            'user_id' => auth()->user()->id,
            'new_price' => $request->new_price,
         ]);
        return new BidResource($bid);
    }

    

    /**
     * @OA\Get(
     * path="/api/v1/bids/{id}",
     * operationId="Get Bid By Id",
     * tags={"Bids"},
     * summary="Get Bid By Id",
     * description="Get Bid By Id",
     * security={{ "apiAuth": {} }},
     * @OA\Parameter(
     *    description="Bid ID",
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
     *          description="Bid Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Bid Return Successfully",
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
        $user = Bid::findOrFail($id);
        return new BidResource($user);
    }


    /**
    * @OA\Put(
    * path="/api/v1/bid/{id}",
    * operationId="Update Bid By ID",
    * tags={"Bids"},
    * summary="Update Bid By ID",
    * description="Update Bid By ID",
    * security={{ "apiAuth": {} }},
    *        @OA\Parameter(
    *       description="Bid ID",
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
    *               required={"product_id", "new_price"},
    *               @OA\Property(property="product_id", type="integer", example="1"),
    *               @OA\Property(property="new_price", type="integer", example="500"),
    *             ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Bid By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Bid By ID Updated Successfully",
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
    public function update(BidRequest $request, string $id)
    {
        $bid = Bid::findOrFail($id);
        $bid->update([
           'product_id' => ($request->product_id) ? $request->product_id : $bid->product_id,
           'new_price' => ($request->new_price) ? $request->new_price : $bid->new_price,
        ]);
        return new BidResource($bid);
    }


     /**
     * @OA\Delete(
     * path="/api/v1/bids/{id}",
     * operationId="Delete Bid By ID",
     * tags={"Bids"},
     * summary="Delete Bid By ID",
     * description="Delete Bid By ID",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *       description="Bid ID",
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
     *          description="Bid By ID Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Bid By ID Deleted Successfully",
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
        $bid = Bid::findOrFail($id);
        if($bid->delete()){
            return response('Bid By ID Deleted Successfully', 200);
        }
    }
}
