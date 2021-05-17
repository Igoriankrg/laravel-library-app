<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @OA\Post(
     *   path="/v1/auth/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *    @OA\Response(
     *        response=200,
     *        description="Current user",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(
     *               @OA\Property(
     *                   property="access_token",
     *                   nullable=false,
     *                   description="Access token",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="token_type",
     *                   nullable=false,
     *                   description="Token type",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="expires_in",
     *                   nullable=false,
     *                   description="Amount of seconds until token expire",
     *                   type="integer"
     *               ),
     *            )
     *        ),
     *    ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Get(
     *    tags={"Auth"},
     *    path="/v1/auth/me",
     *    description="Get current user information",
     *    summary="Return current user",
     *    @OA\Response(
     *        response=200,
     *        description="Current user",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(
     *               @OA\Property(
     *                   property="access_token",
     *                   nullable=false,
     *                   description="Access token",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="token_type",
     *                   nullable=false,
     *                   description="Token type",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="expires_in",
     *                   nullable=false,
     *                   description="Amount of seconds until token expire",
     *                   type="integer"
     *               ),
     *            )
     *        ),
     *    ),
     *    security={
     *        {"jwt_token": "token example"}
     *    }
     * )
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * @OA\Get(
     *    tags={"Auth"},
     *    path="/v1/auth/logout",
     *    description="Logout current user",
     *    summary="Logout current user",
     *    @OA\Response(
     *        response=200,
     *        description="Information",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(
     *               @OA\Property(
     *                   property="message",
     *                   nullable=false,
     *                   description="Message",
     *                   type="string"
     *               ),
     *            )
     *        ),
     *    ),
     *    security={
     *        {"jwt_token": "token example"}
     *    }
     * )
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @OA\Get(
     *    tags={"Auth"},
     *    path="/v1/auth/refresh",
     *    description="Refresh current user token",
     *    summary="Refresh current user token",
     *    @OA\Response(
     *        response=200,
     *        description="Current user",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(
     *               @OA\Property(
     *                   property="access_token",
     *                   nullable=false,
     *                   description="Access token",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="token_type",
     *                   nullable=false,
     *                   description="Token type",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="expires_in",
     *                   nullable=false,
     *                   description="Amount of seconds until token expire",
     *                   type="integer"
     *               ),
     *            )
     *        ),
     *    ),
     *    security={
     *        {"jwt_token": "token example"}
     *    }
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
