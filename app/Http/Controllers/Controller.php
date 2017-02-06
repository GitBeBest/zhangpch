<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function JsonOutPut($data = [], $status= 'ok', $message = '', $code = 0) {
        $out['status'] = $status;
        $out['errMsg'] = $message;
        $out['errCode'] = $code;
        $out['data'] = $data;
        return JsonResponse::create($out);
    }
}
