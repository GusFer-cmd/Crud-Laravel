<?php

namespace App\Jobs;

use App\Services\StundentService;
use App\Services\StudentRedisService;
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
    public function handle(StundentService $service, StudentRedisService $redisService): void
    {
        $tentativas = $this->attempts();
        $status = "Processando";
        $logData = [
            'tentatativas' => $tentativas,
            'status' => $status,
            'id' => $this->id
        ];
        $key = $logData['id'];
    
        try{
            $service->delete($key);
            $redisService->deleteStudent($key);
            $status = "Sucesso";
        } catch (\Exception $e) {
            $status = "Falha";
        }

        $logData['status'] = $status;

        $logJson = json_encode($logData);
        echo "Log JSON: $logJson\n";
    }
}