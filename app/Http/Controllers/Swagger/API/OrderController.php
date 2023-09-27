<?php declare(strict_types=1);

namespace App\Http\Controllers\Swagger\API;

use App\Http\Controllers\BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/users/auth/products/orders",
 *     summary="Список заказанных продуктов.",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="Some title"),
 *                     @OA\Property(property="price", type="float", example="50.25"),
 *                     @OA\Property(property="image", type="object",
 *                         @OA\Property(property="url", type="string", example="https://via.placeholder.com/255x310.png/001100?text=similique"),
 *                     ),
 *                 )
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Post(
 *     path="/api/users/auth/products/orders",
 *     summary="Заказ продуктов.",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="product_ids", type="array",
 *                         @OA\Items(type="integer", example="1")
 *                     )
 *                 ),
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *     )
 * )
 */
class OrderController extends BaseController
{
}
