<?php

namespace App\Traits;

trait ApiResponse {
    public function sendResponse( $message, $code, $data = NULL) {
        $response = [
            'code' => $code,
            // 'message' => trans("app.$message")
            'message' => $message
        ];
        if($code == 422){
            $response = [
                'code' => $code,
                'message' => $message
            ];
        }
        if( isset($data) ){
            $response['data'] = $data;
        }
        return response()->json( $response, $code );
    }
   }
