<?php 

namespace App\Traits;

trait APITrait {
    public function handleResponse($result, string $message): string {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function handleError($error, array $errorMessages = [], $code = 404): string {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        
        return response()->json($response, $code);
    }
}
