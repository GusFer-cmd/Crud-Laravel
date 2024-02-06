<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\StundentService;
use App\Jobs\StudentCreated;
use App\Jobs\StudentDeleted;
use App\Jobs\StudentUpdated;
use App\Models\Student;
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

    public function store(CreateStudentRequest $request)
    {    
        $student = $request->toArray();
        $key = $student['email'];
       
        if (Redis::exists("student:$key")) {
            return redirect()
                ->back()
                ->with('error', 'Recurso não disponível');
        }

        Redis::hmset("student:$key", $student);
       
        StudentCreated::dispatch($student);
        
        return redirect()
            ->route('student.index')
            ->with('success','Student created');
    }
    public function edit(int $id)
    {
        return view('students.edit', ['id' => $this->service->getById($id)]);
    }

    public function update(int $id, UpdateStudentRequest $request)
    {
        StudentUpdated::dispatch($id, $request->all());

        return redirect()
            ->route('student.index')
            ->with('success','Student updated');
    }

    public function delete(int $id)
    {
        StudentDeleted::dispatch($id);

        return redirect()
            ->route('student.index')
            ->with('success','Student deleted');
    }

}
