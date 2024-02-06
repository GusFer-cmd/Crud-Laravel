<?php 

namespace App\Repositories\Eloquent;

use App\Models\Student;

use App\Repositories\Interface\IStudentRepository;
use Illuminate\Support\Collection;

class StudentRepository implements IStudentRepository
{
    public function getAll() : Collection {
        return Student::all();
    }

    public function getById(int $id) : Student|null{
        return Student::Find($id);
    }

    public function getByEmail(string $email) : Student|null{
        return Student::where(['email' => $email])->first();
    }

    public function getByMatricula(string $matricula): Student|null {
        return Student::Find($matricula);
    }

    public function create(Student $student): student{
        return Student::create($student->toArray());
    }

    public function update(Student $student){
        return $student->update($student->toArray());
    }

    public function delete(Student $student){
        return $student->delete();
    }
}