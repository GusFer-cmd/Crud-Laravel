<?php

namespace App\Jobs;

use App\Services\StundentService;
use App\Services\StudentRedisService;
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
    public function handle(StundentService $service, StudentRedisService $redisService): void
    {
        $tentativas = $this->attempts();
        $status = "Processando";
        $logData = [
            'tentativas' => $tentativas,
            'status' => $status,
            'id' => $this->id
        ];
        $key = $logData['id'];
        $student = $redisService->getStudent($key);

        try {
            $service->update($key, $student);
            $status = "Sucesso";
        } catch (\Exception $e) {
            $status = "Falha";
        }

        $redisService->CreateUpdateStudent($key, $student);
        $logData['status'] = $status;

        $logJson = json_encode($logData);
        echo "Log JSON: $logJson\n";
    }
}
