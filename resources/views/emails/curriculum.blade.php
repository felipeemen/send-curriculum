<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Curriculo</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center font-medium">Confirme Suas informações de cadastro</h2>
        <p>Nome: {{ $curriculum['name'] }}</p><br/>
        <p>Email: {{ $curriculum['email'] }}</p><br/>
        <p>Telefone: {{ $curriculum['phone'] }}</p><br/>
        <p>Cargo: {{ $curriculum['position'] }}</p><br/>
        <p>Formação: {{ $curriculum['education'] }}</p><br/>
        <p>Observações: {{ $curriculum['observations'] }}</p><br/>
    </div>
</body>
</html>