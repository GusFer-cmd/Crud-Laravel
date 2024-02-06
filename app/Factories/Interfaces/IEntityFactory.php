<?php

namespace App\Factories\Interfaces;

use App\Models\Student;
use App\Models\User;

interface IEntityFactory {
    public function buildStudent(array $data): Student;
    public function buildUser(array $data): User;
}