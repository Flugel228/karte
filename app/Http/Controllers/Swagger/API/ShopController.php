<?php

namespace App\Http\Controllers\Swagger\API;

use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/shop/products",
 *     summary="Пагинация продуктов",
 *     tags={"Shop"},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="page", type="integer", example="1"),
 *                     @OA\Property(property="category_ids", type="array",
 *                         @OA\Items(type="integer", example="1")
 *                     ),
 *                     @OA\Property(property="color_ids", type="array",
 *                         @OA\Items(type="integer", example="1")
 *                     ),
 *                     @OA\Property(property="tag_ids", type="array",
 *                         @OA\Items(type="integer", example="1")
 *                     ),
 *                     @OA\Property(property="prices", type="array",
 *                         @OA\Items(type="float", example="157.64")
 *                     ),
 *                     @OA\Property(property="title", oneOf={
 *                             @OA\Schema(type="string", example="Some title"),
 *                             @OA\Schema(type="nullable", example="null"),
 *                         }
 *                     )
 *                 ),
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="13"),
 *                     @OA\Property(property="title", type="string", example="Some title"),
 *                     @OA\Property(property="description", type="string", example="Some description"),
 *                     @OA\Property(property="price", type="float", example="125.50"),
 *                     @OA\Property(property="category", type="string", example="Some category"),
 *                     @OA\Property(property="images", type="array",
 *                         @OA\Items(
 *                             @OA\Property(property="id", type="integer", example="1"),
 *                             @OA\Property(property="path", type="string", example="/tmp/cca6fc22cdb6a612f9219384e9cad9d1.png"),
 *                             @OA\Property(property="url", type="string", example="https://via.placeholder.com/255x310.png/009955?text=sapiente"),
 *                             @OA\Property(property="pivot", type="object",
 *                                 @OA\Property(property="product_id", type="integer", example="1"),
 *                                 @OA\Property(property="image_id", type="integer", example="21"),
 *                             )
 *                         )
 *                     ),
 *                     @OA\Property(property="colors", type="array",
 *                         @OA\Items(
 *                             @OA\Property(property="id", type="integer", example="1"),
 *                             @OA\Property(property="title", type="string", example="Some title"),
 *                             @OA\Property(property="code", type="string", example="#ffffff"),
 *                         )
 *                     )
 *                 ),
 *             ),
 *             @OA\Property(property="links", type="object",
 *                 @OA\Property(property="first", type="string", example="http://localhost:8876/api/shop/products?page=1"),
 *                 @OA\Property(property="last", type="string", example="http://localhost:8876/api/shop/products?page=5"),
 *                 @OA\Property(property="prev", type="string", example="http://localhost:8876/api/shop/products?page=1"),
 *                 @OA\Property(property="next", type="string", example="http://localhost:8876/api/shop/products?page=3"),
 *             ),
 *             @OA\Property(property="meta", type="object",
 *                 @OA\Property(property="current_page", type="integer", example="2"),
 *                 @OA\Property(property="from", type="integer", example="13"),
 *                 @OA\Property(property="last_page", type="integer", example="5"),
 *                 @OA\Property(property="links", type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="url", type="string", example="http://localhost:8876/api/shop/products?page=1"),
 *                         @OA\Property(property="label", type="string", example="&laquo; Previous"),
 *                         @OA\Property(property="active", type="boolean", example="false"),
 *                     ),
 *                 ),
 *                 @OA\Property(property="path", type="string", example="http://localhost:8876/api/shop/products"),
 *                 @OA\Property(property="per_page", type="integer", example="12"),
 *                 @OA\Property(property="to", type="integer", example="24"),
 *                 @OA\Property(property="total", type="integer", example="51"),
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/shop/categories",
 *     summary="Список категорий",
 *     tags={"Shop"},
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="Some title"),
 *                 )
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/shop/colors",
 *     summary="Список цветов",
 *     tags={"Shop"},
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="Purple"),
 *                     @OA\Property(property="code", type="string", example="#4fce3f"),
 *                 )
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/shop/tags",
 *     summary="Список тегов",
 *     tags={"Shop"},
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="Some title"),
 *                 )
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/shop/prices",
 *     summary="Минимальная и максимальная цены.",
 *     tags={"Shop"},
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="min", type="float", example="0"),
 *             @OA\Property(property="max", type="float", example="100"),
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/shop/products/{product}",
 *     summary="Единичная запись продукта",
 *     tags={"Shop"},
 *
 *     @OA\Parameter(
 *         description="ID продукта",
 *         in="path",
 *         name="product",
 *         required=true,
 *         example="1"
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="title", type="string", example="Some title"),
 *                 @OA\Property(property="description", type="string", example="Some decription"),
 *                 @OA\Property(property="price", type="float", example="1608.03"),
 *                 @OA\Property(property="quantity", type="integer", example="500"),
 *                 @OA\Property(property="category", type="string", example="Some category"),
 *                 @OA\Property(property="images", type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="id", type="integer", example="1"),
 *                         @OA\Property(property="path", type="string", example="/tmp/b472bb4d6f8f0f642b25a0466a4a2895.png"),
 *                         @OA\Property(property="url", type="string", example="https://via.placeholder.com/255x310.png/001100?text=similique"),
 *                         @OA\Property(property="pivot", type="object",
 *                             @OA\Property(property="product_id", type="integer", example="1"),
 *                             @OA\Property(property="image_id", type="integer", example="31")
 *                         ),
 *                     )
 *                 ),
 *                 @OA\Property(property="colors", type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="id", type="integer", example="1"),
 *                         @OA\Property(property="title", type="string", example="MediumOrchid"),
 *                         @OA\Property(property="code", type="string", example="#eb71fa")
 *                     )
 *                 ),
 *                 @OA\Property(property="tags", type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="id", type="integer", example="1"),
 *                         @OA\Property(property="title", type="string", example="Some title"),
 *                     )
 *                 ),
 *                 @OA\Property(property="likedUsers", type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="id", type="integer", example="1"),
 *                     )
 *                 ),
 *             ),
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/shop/products/recent",
 *     summary="Возвращает самые новые 5 продуктов",
 *     tags={"Shop"},
 *
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="Some title"),
 *                     @OA\Property(property="price", type="float", example="100.50"),
 *                     @OA\Property(property="category", type="string", example="Some category"),
 *                     @OA\Property(property="image", type="object",
 *                          @OA\Property(property="id", type="integer", example="1"),
 *                          @OA\Property(property="path", type="string", example="/path"),
 *                          @OA\Property(property="url", type="string", example="https://localhost/path"),
 *                          @OA\Property(property="pivot", type="object",
 *                              @OA\Property(property="product_id", type="integer", example="1"),
 *                              @OA\Property(property="image_id", type="integer", example="1")
 *                          ),
 *                     ),
 *                 )
 *             )
 *         )
 *     )
 * )
 */
class ShopController extends Controller
{
}
