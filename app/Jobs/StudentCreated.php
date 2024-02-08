<?php

namespace App\Jobs;

use App\Services\StudentRedisService;
use App\Services\StundentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class StudentCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private array $data)
    {
    }

    public function handle(StundentService $service, StudentRedisService $redisService): void
    {
        $tentativas = $this->attempts();
        $status = 'Processando';
        $logData = [
            'tentativas' => $tentativas,
            'status' => $status,
            'email' => $this->data['email']
        ];

        $student = $redisService->getStudent($logData['email']); //Salvar state no Redis
        
        try {
            $service->create($student);
            $status = "Sucesso";
        } catch (\Exception $e) {
            $status = "Falha";
        }

        $redisService->CreateUpdateStudent($logData['email'], $student);
        $logData['status'] = $status;

        $logJson = json_encode($logData);
        echo "Log JSON: $logJson\n";
        //cluster
    }
}
