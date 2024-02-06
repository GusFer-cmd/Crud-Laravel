<x-layout>
    <x-slot:title>
        Students List
    </x-slot>

    @error('message')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <h1>Students</h1>
    <div>
        <div class="btn-group mb-2">
            <a class="btn btn-secondary" href="/">Início</a>
            <a class="btn btn-primary" href="{{route('student.create')}}">New Student</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hovered">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Matricula</th>
                    <th class="text-center">Options</th>
                </tr>
                @foreach($students as $student)
                <tr>
                    <td class="text-center">{{$student->id}}</td>
                    <td class="text-center">{{$student->name}}</td>
                    <td class="text-center">{{$student->email}}</td>
                    <td class="text-center">{{$student->matricula}}</td>
                    <td class="text-center">
                        <form method="post" action="{{route('student.delete', ['id' => $student->id])}}">
                            @csrf
                            @method('delete')
                            <div class="btn-group" role="group">
                                <a class="btn btn-outline-primary" href="{{route('student.edit', ['id' => $student->id ])}}">Edit</a>
                                <button class="btn btn-outline-danger" type="submit">Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-layout>