<?php
  
namespace App\Http\Controllers;

use App\Jobs\GenerateUserPdfJob;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $users = User::get();

        GenerateUserPdfJob::dispatch($users, Auth::user()->id);
     
        return response("Success", 200)->header('Content-Type', 'application/pdf');
    }
}
