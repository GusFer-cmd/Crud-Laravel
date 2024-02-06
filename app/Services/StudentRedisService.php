<?php

namespace App\Services;
use Illuminate\Support\Facades\Redis;

class StudentRedisService 
{

    public function checkStudent(string $key) : bool
    {
        return Redis::exists("student:$key");
    }

    public function storeStudent(string $key, array $data): void
    {
        Redis::hmset("student:$key", $data);
    }

    public function getStudent(string $key): array
    {
        return Redis::hgetall("student:$key");
    }

}