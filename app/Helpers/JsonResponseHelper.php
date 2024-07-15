<?php

if (!function_exists('json_response')) {
    /**
     * Return a JSON response.
     *
     * @param  bool  $success
     * @param  array|null  $data
     * @param  int  $status
     * @return \Illuminate\Http\JsonResponse
     */
    function json_response($success = true, $data = null, $status = 200) {
        return response()->json(['success' => $success, 'data' => $data], $status);
    }
}
