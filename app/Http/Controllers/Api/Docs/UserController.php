<?php

namespace App\Http\Controllers\Api\Docs;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *      path="/api/users",
 *      summary="Список всех пользователей",
 *      description="Администратору отображается список всех пользователей, а остальным пользователям - все, кроме администратора",
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
 * @OA\Post(
 *      path="/api/users/toggle_notice",
 *      summary="Переключение статуса получения уведомления о создании заметок",
 *      tags={"Пользователь"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Статус получение уведомлений переключен на вкл/выкл"),
 *          ),
 *      ),
 * ),
 * 
 */
class UserController extends Controller
{
    //
}
