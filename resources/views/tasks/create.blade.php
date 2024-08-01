<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Creado una tarea</h1>
                    <hr>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Volver</a>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="/tasks" method="POST">
                        @csrf
                        <div>
                            <label class="form-label" for="name">Nombre</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                            @error('name')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="priority_id">Prioridad</label>
                            <select name="priority_id" id="priority_id" class="form-control">
                                @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                @endforeach
                            </select>
                            @error('priority_id')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="user_id">Asignar a Usuario</label>
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="description">Descripción</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="tags">Etiquetas</label>
                            <select name="tags[]" id="tags" class="form-control" multiple>
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Crear tarea</button>
                    </form>
                <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
</x-app-layout>