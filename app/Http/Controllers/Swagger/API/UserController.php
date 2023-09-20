<?php

namespace App\Http\Controllers\Swagger\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/users/",
 *     summary="Регистрация пользователя",
 *     tags={"User"},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="first_name", type="string", example="FirstName"),
 *                     @OA\Property(property="last_name", type="string", example="LastName"),
 *                     @OA\Property(property="gender", type="integer", example="1"),
 *                     @OA\Property(property="address", type="string", example="Some address"),
 *                     @OA\Property(property="telephone", type="string", example="+37588003346"),
 *                     @OA\Property(property="email", type="string", example="example@example.org"),
 *                     @OA\Property(property="password", type="string", example="Password1@#"),
 *                     @OA\Property(property="confirm_password", type="string", example="Password1@#"),
 *                 ),
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Пользователь создан."),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/users/genders",
 *     summary="Список гендеров",
 *     tags={"User"},
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(type="string", example="Мужчина")
 *             )
 *         )
 *     )
 * ),
 */
class UserController extends Controller
{
}
