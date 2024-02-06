<?php

namespace App\Repositories\Interface;

use App\Models\Student;
use Illuminate\Support\Collection;

interface IStudentRepository
{
    public function getAll(): Collection;
    public function getById(int $id): Student|null;
    public function getByEmail(string $email): Student|null;
    public function getByMatricula(string $matricula): Student|null;
    public function create(Student $student);
    public function update(Student $student);
    public function delete(Student $student);
}