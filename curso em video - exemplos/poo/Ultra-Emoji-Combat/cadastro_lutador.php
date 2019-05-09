<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <title>Cadastro</title>
    </head>
    <body>
        <div>
            <form action="" method="post">
                Nome: <input type="text" name="nome"/><br/><br/>
                Nacionalidade: <select name="nacionalidade">
                                   <option value="">--- Selecione o Pais ---</option>
                               </select><br/><br/>
                Data de Nascimento: <input type="date" name="data"><br/><br/>
                Altura: <input type="number" name="altura"/><br/><br/>
                Peso: <input type="number" name="peso"/><br/><br/>
                <input type="submit" value="Cadastrar" class="button"/><br/>
            </form>
        </div>

        <?php
            echo $_POST['nome'] . '<br/>' . $_POST['peso'] . '<br/>';
        ?>
    </body>
</html>