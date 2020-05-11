<?php


namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * @param $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data, $code = Response::HTTP_OK) {
        return response()->json(['data' => $data], $code);
    }

    /**
     * @param $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message, $code) {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

}
