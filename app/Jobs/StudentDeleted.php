<?php

namespace App\Jobs;

use App\Services\StundentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentDeleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $id)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(StundentService $service): void
    {
        $service->delete($this->id);
        echo "StudentDeleted: OK\n";
    }
}