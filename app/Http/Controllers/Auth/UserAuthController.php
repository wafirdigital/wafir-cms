<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserAuthController extends Controller
{
    
    /**
     * @OA\Post(
     * path="/api/v1/auth/register",
     * operationId="Register New User",
     * tags={"Auth"},
     * summary="Register New User",
     * description="Register New User",
     * security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"first_name", "last_name", "email", "password" },
     *                @OA\Property(property="first_name", type="text", example="WAFIR"),
     *                @OA\Property(property="last_name", type="text", example="Author"),
     *                @OA\Property(property="email", type="text", example="author@wafir.digital"),
     *                @OA\Property(property="password", type="text", example="12345678"),
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
    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('token')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
 
    /**
    * @OA\Post(
    * path="/api/v1/auth/login",
    * operationId="Do Login",
    * tags={"Auth"},
    * summary="User Login",
    * description="Login User",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"email", "password"},
    *                @OA\Property(property="email", type="text", example="author@wafir.digital"),
    *                @OA\Property(property="password", type="text", example="12345678"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Login Successfully",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Login Successfully",
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
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('token')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }   
}
