<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use PDF;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function mypdf() {
        $pdf = PDF::loadView("mypdf");
        return $pdf->download('mypdf.pdf');
    }
}
