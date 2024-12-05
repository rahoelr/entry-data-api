<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiResponse
{

    public static function rollback(\Exception $e, string $message = "Something went wrong! Process not completed")
    {
        DB::rollBack();
        self::logAndThrow($e, $message);
    }

    public static function logAndThrow(\Exception $e, string $message = "Something went wrong! Process not completed")
    {
        Log::error($e->getMessage(), ['exception' => $e]);
        throw new HttpResponseException(
            response()->json(['message' => $message], 500)
        );
    }

    public static function success($result, string $message = null, int $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }

    public static function error(string $message = null, int $code = 500, array $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message ?? 'An error occurred.',
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
