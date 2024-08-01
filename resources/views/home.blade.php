<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="custom-bg">
    <!-- Header -->
    <header class="bg-light py-3 shadow-sm">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <h1 class="h3 mb-0">Tasks</h1>
                </div>
                <div class="col-lg-3 text-end">
                    @if (Route::has('login'))
                        <nav class="nav justify-content-end">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary me-2">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-4">
    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Prioridad</th>
                <th>Usuario</th>
                <th>Etiquetas</th>
                <th>Completada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td><a>{{ $task->name }}</a></td>
                    <td>{{ $task->priority?->name }}</td>
                    <td>{{ $task->user?->name ?? 'No asignado' }}</td>
                    <td>
                        @foreach ($task->tags as $tag)
                            <span class="badge bg-primary">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>
                    @if (!$task->completed)
                        Pendiente
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-check2-circle" viewBox="0 0 16 16">
                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                    </svg>
                    Completada
                    @endif
                </td>

                <td>
                    @if (!$task->completed)
                        <form action="/tasks/{{ $task->id }}/complete" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Completar</button>
                        </form>
                    @else
                        <span>-</span>
                    @endif
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

</body>

</html>
