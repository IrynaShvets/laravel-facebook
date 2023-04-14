<?php

namespace App\Jobs;

use App\Events\SendPdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Storage;

class GenerateUserPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $users;
    public $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct($users, $user_id)
    {
        $this->users = $users;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $this->users,

        ]; 
      
        $filename = storage_path('/app/public/pdf').'/users.pdf';
       
        $pdf = Pdf::loadView('myPDF', $data);
        $file = Storage::put('pdf/users.pdf', $pdf->output());
        $filePath = Storage::url('pdf/users.pdf');
        broadcast(new SendPdf($filePath, $this->user_id));
    }
}
