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
                    <h1>Tarea ID: {{ $task->id }}</h1>
                    <hr>
                    <a href="{{ route('tasks.index') }}">
                        <button type="button" class="btn btn-outline-primary">Volver</button>
                    </a>

                    <table class="table table-striped-columns">
                        <tr>
                            <td>
                                <h2>{{ $task->name }}</h2>
                            </td>
                            <td>
                                <p>{{ $task->description }}</p>
                            </td>
                        </tr>
                    </table>

                    <a href="{{ route('tasks.edit', $task->id) }}">
                        <button type="button" class="btn btn-outline-success">Editar</button>
                    </a>

                    <!-- Formulario para eliminar la tarea -->
                    <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                    </form>
                    
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <!-- Contenido adicional aquí -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
