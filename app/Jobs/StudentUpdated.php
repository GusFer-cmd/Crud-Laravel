<?php

namespace App\Jobs;

use App\Services\StundentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $id, private array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(StundentService $service): void
    {
        $service->update($this->id, $this->data);
        echo "StudentUpdated: OK\n";
    }
}
