<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\StundentService;
use App\Jobs\StudentCreated;
use App\Jobs\StudentDeleted;
use App\Jobs\StudentUpdated;
use App\Models\Student;
use App\Services\StudentRedisService;
use Illuminate\Support\Facades\Redis;

class StudentController extends Controller
{
    private StundentService $service;

    public function __construct(StundentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $students = $this->service->getAll();

        return view('students.index', ['students' => $students]);
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(CreateStudentRequest $request, StudentRedisService $redisService)
    {    
        $student = $request->toArray();
        $key = $student['email'];
       
        if ($redisService->checkStudent($key)) { 
            return redirect()
                ->back()
                ->with('error', 'Recurso não disponível');
        }

        $redisService->CreateUpdateStudent($key, $student);
        
        StudentCreated::dispatch($student);
        
        return redirect()
            ->route('student.index')
            ->with('success','Student created');
    }

    public function edit(int $id)
    {
        return view('students.edit', ['id' => $this->service->getById($id)]);
    }

    public function update(int $id, UpdateStudentRequest $request, StudentRedisService $redisService)
    {
        $student = $request->all();

        if ($redisService->checkStudent($id)) { 
            return redirect()
                ->back()
                ->with('error', 'Recurso não disponível');
        }

        $redisService->CreateUpdateStudent($id, $student);

        StudentUpdated::dispatch($id, $student);

        return redirect()
            ->route('student.index')
            ->with('success','Student updated');
    }

    public function delete(int $id, StudentRedisService $redisService)
    {
        if ($redisService->checkStudent($id)) { 
            return redirect()
                ->back()
                ->with('error', 'Recurso não disponível');
        }

        $redisService->deleteStudent($id);

        StudentDeleted::dispatch($id);

        return redirect()
            ->route('student.index')
            ->with('success','Student deleted');
    }

}
