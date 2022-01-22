<?php 

namespace App\Traits;

trait APITrait {
    public function handleResponse($result, $message) {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function handleError($error, $errorMessages = [], $code = 404) {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        
        return response()->json($response, $code);
    }
}
