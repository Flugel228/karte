<?php

namespace App\Http\Controllers\Swagger\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/users/auth/products/comments",
 *     summary="Сохранение комментария",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="product_id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="Some title"),
 *                     @OA\Property(property="comment", type="string", example="Some comment"),
 *                     @OA\Property(property="rate", type="integer", example="5"),
 *                 ),
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *     ),
 * ),
 *
 */
class CommentController extends Controller
{
}
