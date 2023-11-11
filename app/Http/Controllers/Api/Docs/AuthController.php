<?php

namespace App\Http\Controllers\Api\Docs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *      path="/api/user/login",
 *      summary="Авторизация пользователя в системе",
 *      tags={"Пользователь"},
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="email", type="string", example="test@test.ru"),
 *                      @OA\Property(property="password", type="string", example=12345678),
 *                  )
 *              },
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="message", type="string", example="Вы успешно авторизованы!"),
 *                  @OA\Property(property="token", type="string", example="Bearer токен пользователя"),
 *              ),
 *          ),
 *      ),
 * ),
 * 
 * @OA\Get(
 *      path="/api/user/profile",
 *      summary="Получить авторизованного пользователя по токену",
 *      tags={"Пользователь"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(property="data", type="array", @OA\Items(
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="surname", type="string", example="Иванов"),
 *                  @OA\Property(property="name", type="string", example="Иван"),
 *                  @OA\Property(property="patronymic", type="string", example="Иванович"),
 *                  @OA\Property(property="fio", type="string", example="Иванов Иван Иванович"),
 *                  @OA\Property(property="email", type="string", example="test@test.ru"),
 *                  @OA\Property(property="isAdmin", type="boolean", example="Нет"),
 *              )),
 *          ),
 *      ),
 * ),
 * 
 */
class AuthController extends Controller
{
    //
}
