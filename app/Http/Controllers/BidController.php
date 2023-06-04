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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(BidRequest $request, string $id)
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
