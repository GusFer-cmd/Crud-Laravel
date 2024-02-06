<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Sistema</title>
    
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="text-center">Bem-vindo ao Sistema</h1>
            <p class="text-center">Obrigado por escolher nosso sistema! Estamos felizes em tê-lo(a) a bordo.</p>
            <p class="text-center">Cadastre seus alunos aqui:</p>
            <a class="btn btn-primary" href="{{route('student.index')}}">Students</a>
        </div>

    
    </div>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
