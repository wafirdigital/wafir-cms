<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    
    /**
     * @OA\Get(
     * path="/api/v1/users",
     * operationId="Users",
     * tags={"Users"},
     * summary="Get All Users",
     * description="Get All Users",
     * security={{ "apiAuth": {} }},
     *     
     *      @OA\Response(
     *          response=201,
     *          description="Users Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Users Return Successfully",
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
        return UserResource::collection(User::paginate(10));
    }

    
    /**
     * @OA\Post(
     * path="/api/v1/users",
     * operationId="Add New User",
     * tags={"Users"},
     * summary="Add New User",
     * description="Add New User",
     * security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"first_name", "last_name", "email", "password" },
     *               @OA\Property(property="first_name", type="text", example="Odai"),
     *               @OA\Property(property="last_name", type="text", example="Nasser"),
     *               @OA\Property(property="email", type="text", example="odai@wafir.digital"),
     *               @OA\Property(property="password", type="text", example="12345678"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="User Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="User Created Successfully",
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
    public function store(UserRequest $request)
    {
        $user= User::create([
            'first_name' =>  $request->first_name,
            'last_name' =>  $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
         ]);
        return new UserResource($user);
    }

   

    /**
     * @OA\Get(
     * path="/api/v1/users/{id}",
     * operationId="Get User By Id",
     * tags={"Users"},
     * summary="Get User By Id",
     * description="Get User By Id",
     * security={{ "apiAuth": {} }},
     * @OA\Parameter(
     *    description="User ID",
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
     *          description="User By ID Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="User By ID Return Successfully",
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
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
    * @OA\Put(
    * path="/api/v1/users/{id}",
    * operationId="Update User By ID",
    * tags={"Users"},
    * summary="Update User By ID",
    * description="Update User By ID",
    * security={{ "apiAuth": {} }},
    *        @OA\Parameter(
    *       description="User ID",
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
    *               required={"first_name", "last_name", "email", "status"},
    *               @OA\Property(property="first_name", type="text", example="Odai"),
    *               @OA\Property(property="last_name", type="text", example="Nasser"),
    *               @OA\Property(property="email", type="text", example="odai@wafir.digital"),
    *               @OA\Property(property="status", type="text", example="active"),
    *               @OA\Property(property="password", type="text", example=""),
    *             ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="User By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="User By ID Updated Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=422,
    *          description="Unprocessable Entity",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="User Not Found"),
    * )
    */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->update([
                'first_name' => ($request->first_name) ? $request->first_name : $user->first_name,
                'last_name' => ($request->last_name) ? $request->last_name : $user->last_name,
                'email' => ($request->email) ? $request->email : $user->email,
                'status' => ($request->status) ? $request->status : $user->status,
                'password' => ($request->password) ? bcrypt($request->password): $user->password,
            ]);

        return new UserResource($user);
    }

    /**
     * @OA\Delete(
     * path="/api/v1/users/{id}",
     * operationId="Delete User By ID",
     * tags={"Users"},
     * summary="Delete User By ID",
     * description="Delete User By ID",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *       description="User ID",
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
     *          description="User By ID Return Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="User By ID Deleted Successfully",
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
        $user = User::findOrFail($id);
        if($user->delete()){
            return response('User By ID Deleted Successfully', 200);
        }
    }
}
