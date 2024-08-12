<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Cadastro</title>
    <style>
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    </style>
</head>
<body class="bg-gray-100 p-4">
<div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Confirmação de Cadastro</h2>
    <p class="mb-4">Olá {{ $name }},</p>
    <p class="mb-4">Seu cadastro foi realizado com sucesso em {{ now()->format('d/m/Y H:i') }}</p>
    <a href="{{ route('login') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Ir para o Login</a>
</div>
</body>
</html>
