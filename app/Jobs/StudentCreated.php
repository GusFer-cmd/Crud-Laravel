<?php

namespace App\Jobs;

use App\Services\StundentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private array $data)
    {
    }

    public function handle(StundentService $service): void
    {
        $tentativas = $this->attempts();
        $status = 'Processando';
        echo "Tentativas: $tentativas\n";

        try {
            $service->create($this->data);
            $status = "Sucesso";
        } catch (\Exception $e) {
            $status = "Falha";
        }

        echo "StudentCreated: $status\n";
    }
}
