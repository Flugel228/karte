<?php

namespace App\Http\Controllers\Swagger\API;

use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/users/auth/login",
 *     summary="Получение JWT-токен, используя заданные учетные данные",
 *     tags={"User"},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="email", type="string", example="example@exapmle.com"),
 *                     @OA\Property(property="password", type="string", example="Password1@#"),
 *                 ),
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg4NzYvYXBpL3VzZXJzL2xvZ2luIiwiaWF0IjoxNjk0MjMzNDI5LCJleHAiOjE2OTQyMzcwMjksIm5iZiI6MTY5NDIzMzQyOSwianRpIjoid011VEtxeHZXOVlxQU5pUCIsInN1YiI6IjUxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.fT5hk6B0wgFKffQ29YWoOZ-gv45itznc0EzSJDbyuWU"),
 *             @OA\Property(property="token_type", type="string", example="bearer"),
 *             @OA\Property(property="expires_in", type="integer", example="3600")
 *             )
 *         )
 *     )
 * ),
 *
 *
 * @OA\Post(
 *     path="/api/users/auth/me",
 *     summary="Получить аунтефицированного пользователя",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example="1"),
 *             @OA\Property(property="first_name", type="string", example="FirstName"),
 *             @OA\Property(property="last_name", type="string", example="LastName"),
 *             @OA\Property(property="role", type="integer", example="0"),
 *             @OA\Property(property="gender", type="integer", example="0"),
 *             @OA\Property(property="address", type="string", example="Some address"),
 *             @OA\Property(property="telephone", type="string", example="+375259530534"),
 *             @OA\Property(property="email", type="string", example="example@example.com"),
 *             @OA\Property(property="email_verified_at", oneOf={
 *                     @OA\Schema(type="string", format="date-time", example="2023-09-05T10:22:25.000000Z"),
 *                     @OA\Schema(type="nullable", example="null")
 *                 }
 *             ),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2023-09-05T10:22:25.000000Z"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", example="2023-09-05T10:22:25.000000Z"),
 *         )
 *     )
 * ),
 *
 * @OA\Post(
 *     path="/api/users/auth/refresh",
 *     summary="Получить обновленный токен",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg4NzYvYXBpL3VzZXJzL2xvZ2luIiwiaWF0IjoxNjk0MjMzNDI5LCJleHAiOjE2OTQyMzcwMjksIm5iZiI6MTY5NDIzMzQyOSwianRpIjoid011VEtxeHZXOVlxQU5pUCIsInN1YiI6IjUxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.fT5hk6B0wgFKffQ29YWoOZ-gv45itznc0EzSJDbyuWU"),
 *             @OA\Property(property="token_type", type="string", example="bearer"),
 *             @OA\Property(property="expires_in", type="integer", example="3600")
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Post(
 *     path="/api/users/auth/logout",
 *     summary="Выйти из системы(сделать токен не действительным)",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Successfully logged out")
 *         )
 *     ),
 * ),
 *
 * @OA\Post(
 *     path="/api/users/auth/wishlist",
 *     summary="Список понравившихся продуктов.",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="Some title"),
 *                     @OA\Property(property="price", type="float", example="50.25"),
 *                     @OA\Property(property="image", type="object",
 *                         @OA\Property(property="id", type="integer", example="1"),
 *                         @OA\Property(property="path", type="string", example="/tmp/b472bb4d6f8f0f642b25a0466a4a2895.png"),
 *                         @OA\Property(property="url", type="string", example="https://via.placeholder.com/255x310.png/001100?text=similique"),
 *                     ),
 *                 )
 *             )
 *     )
 * )
 */
class AuthController extends Controller
{
}
