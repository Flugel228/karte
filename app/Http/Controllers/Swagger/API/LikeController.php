<?php

namespace App\Http\Controllers\Swagger\API;

use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/users/auth/products/likes",
 *     summary="Поставить/Сбросить лайк",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="product_id", type="integer", example="1"),
 *                 ),
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         )
 *     )
 * ),
 */
class LikeController extends Controller
{
}
