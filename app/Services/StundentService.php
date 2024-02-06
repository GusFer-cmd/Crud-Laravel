<?php

namespace App\Services;

use App\Exceptions\AlreadyEmailException;
use App\Exceptions\AlreadyMatriculaException;
use App\Exceptions\NotFoundException;
use App\Factories\Interfaces\IEntityFactory;
use App\Models\Student;
use App\Repositories\Interface\IStudentRepository;
use Illuminate\Support\Collection;


class StundentService
{
    private $repo;
    private $factory;

    public function __construct(IStudentRepository $repo, IEntityFactory $factory)
    {
        $this->repo = $repo;
        $this->factory = $factory;
    }

    public function create(array $data)
    {
        $student = $this->factory->buildStudent($data);
        if ($this->repo->getByEmail($student->email) !== null)
            throw new AlreadyEmailException();

        return $this->repo->create($student);
    }

    public function getAll(): Collection
    {
        return $this->repo->getAll();
    }

    public function getById(int $id): Student|null
    {
        $student = $this->repo->getById($id);
        if ($student === null)
            throw new NotFoundException();

        return $student;
    }

    public function getByEmail(string $email): Student|null
    {
        $student = $this->repo->getByEmail($email);
        if ($student === null)
            throw new NotFoundException();
        
            return $student;
    }

    public function getByMatricula(string $matricula): Student|null
    {
        $student = $this->repo->getByMatricula($matricula);
        if ($student === null)
            throw new AlreadyMatriculaException();
        
        return $student;
    }

    public function update(int $id, array $data)
    {
        $existStudent = $this->repo->getByMatricula($data['matricula']);

        if ($existStudent !== null && $existStudent->id !== $id)
            throw new AlreadyMatriculaException();
        
        $student = $this->repo->getById($id);
        if($student === null)
            throw new NotFoundException();

        $student->name = $data["name"];
        $student->email = $data["email"];
        $student->matricula = $data["matricula"];
        
        return $this->repo->update($student);
    }

    public function delete(int $id)
    {
        $student = $this->repo->getById($id);
        if ($student === null)
            throw new NotFoundException();

        return $this->repo->delete($student);
    }
}
