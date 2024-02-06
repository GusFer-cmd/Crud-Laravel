<x-layout>
    <x-slot:title>
        Register student
    </x-slot>

    @error('message')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <h1>Register student</h1>
    <form method="post" action="{{route('student.store')}}">
        @csrf
        @method('post')
        <div class="mb-2">
            <input type="text" name="name" placeholder="Name" value="{{old('name')}}"  class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <input type="email" name="email" placeholder="email@.com" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <input type="number" name="matricula" placeholder="Matrícula (ex:000000)" value="{{old('matricula')}}" class="form-control @error('matricula') is-invalid @enderror">
            @error('matricula')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <div class="btn-group" role="group">
                <a href="{{route('student.index')}}" class="btn btn-secondary">Go Back</a>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
</x-layout>