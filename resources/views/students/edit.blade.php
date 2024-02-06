<x-layout>
    <x-slot:title>
        Edit Client
    </x-slot>

    @error('message')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <h1>Edit Client</h1>
    <form method="post" action="{{route('student.update', ['id' => $id])}}">
        @csrf
        @method('put')
        <div class="mb-2">
            <input type="text" name="name" placeholder="Name" value="{{old('name', $id->name)}}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <input type="email" name="email" placeholder="email@.com" value="{{old('email', $id->email)}}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <input type="text" name="matricula" placeholder="000000" value="{{old('matricula', $id->matricula)}}" class="form-control @error('matricula') is-invalid @enderror">
            @error('matricula')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <div class="btn-group" role="group">
                <a href="{{route('student.index')}}" class="btn btn-secondary">Go Back</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

</x-layout>