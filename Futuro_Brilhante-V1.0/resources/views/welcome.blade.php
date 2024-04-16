<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
                    
                <form  action="/cadastrar_aluno" method="POST">
                    @csrf
                    <label for="nome">Nome:</label><br>
                    <input type="text" id="nome" name="nome"><br>

                    <label for="sobrenome">Sobrenome:</label><br>
                    <input type="text" id="sobrenome" name="sobrenome"><br>

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email"><br>

                    <label for="senha">Senha:</label><br>
                    <input type="password" id="senha" name="senha"><br>
                    
                    <button type="submit">Enviar</button>
                </form>
</body>
</html>