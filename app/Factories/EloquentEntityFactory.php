<?php

namespace App\Factories;

use App\Factories\Interfaces\IEntityFactory;
use App\Models\Student;
use App\Models\User;

class EloquentEntityFactory implements IEntityFactory
{
    public function buildStudent(array $data): Student
    {
        return new Student($data);
    }

    public function buildUser(array $data): User
    {
        return new User($data);
    }
}