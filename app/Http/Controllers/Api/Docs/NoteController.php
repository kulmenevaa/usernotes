<?php

namespace App\Http\Controllers\Api\Docs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *      path="/api/notes",
 *      summary="Список заметок пользователя",
 *      description="Администратору отображается список всех заметок, а остальным пользователям - личные заметки",
 *      tags={"Заметки"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(property="data", type="array", @OA\Items(
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="title", type="string", example="Заметка №1"),
 *                  @OA\Property(property="description", type="string", example="Описание заметки №1"),
 *              )),
 *          ),
 *      ),
 * ),
 * 
 * @OA\Post(
 *      path="/api/notes",
 *      summary="Создание заметки",
 *      description="При создании заметки пользователю с ролью администратора приходит письмо с содержимым созданной заметки",
 *      tags={"Заметки"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="title", type="string", example="Заметка №1"),
 *                      @OA\Property(property="description", type="string", example="Описание заметки №1"),
 *                  )
 *              },
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Заметка добавлена"), 
 *              @OA\Property(property="data", type="object", example={"id": 2, "title": "Заметка №2", "description": "Описание заметки №2"}),
 *          ),
 *      ),
 * ),
 * 
 * @OA\Patch(
 *      path="/api/notes/{note}",
 *      summary="Обновление заметки",
 *      tags={"Заметки"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Parameter(
 *          description="ID заметки",
 *          in="path",
 *          name="note",
 *          required=true,
 *          example=2
 *      ),
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="title", type="string", example="Заметка №2"),
 *                      @OA\Property(property="description", type="string", example="Описание заметки №2"),
 *                  )
 *              }
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Заметка изменена"), 
 *              @OA\Property(property="data", type="object", example={"id": 2, "title": "Заметка №2 - корректировка", "description": "Описание заметки №2"}),
 *          ),
 *      ),
 * ),
 * 
 * @OA\Delete(
 *      path="/api/notes/{note}",
 *      summary="Удаление заметки",
 *      description="Если пользователь является администратором, то заметка удаляется из системы. Для остальных - заметка удаляется из списка пользователя, но администратор увидит её в системе",
 *      tags={"Заметки"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Parameter(
 *          description="ID заметки",
 *          in="path",
 *          name="note",
 *          required=true,
 *          example=2
 *      ),
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="message", type="sting", example="Заметка удалена")
 *                  )
 *              }
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="sting", example="Заметка удалена")
 *          ),
 *      ),
 * ),
 * 
 */
class NoteController extends Controller
{
    //
}
