<?php

namespace App\Http\Controllers\Api\Docs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *      path="/api/user_note/share",
 *      summary="Поделиться заметкой с другим пользователем",
 *      tags={"Заметки"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="noteID", type="integer", example="1"),
 *                      @OA\Property(property="usersShare", type="string", example="1,2,3"),
 *                  )
 *              }
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Вы поделились заметкой"), 
 *          ),
 *      ),
 * ),
 * 
 */
class UserNoteController extends Controller
{
    //
}
