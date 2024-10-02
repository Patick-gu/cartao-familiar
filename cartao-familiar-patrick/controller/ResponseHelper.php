<?php

class ResponseHelper
{
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_CONFLICT = 409;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_METHOD_NOT_ALLOWED = 405;

    public static function sendResponse($data, $statusCode = self::HTTP_OK)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function sendSuccess($message, $data = [], $statusCode = self::HTTP_OK)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
        self::sendResponse($response, $statusCode);
    }

    public static function sendError($message, $statusCode = self::HTTP_BAD_REQUEST)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];
        self::sendResponse($response, $statusCode);
    }
}
