<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>
            <?php
            if (isset($title)) {
                echo 'Projeto Inovasie :: ' . $title;
            } else {
                echo 'Projeto Inovasie :: Aluno';
            }
            ?>
        </title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

        <!-- Bootstrap´JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="container">
            <br/>
            <h2>Lista de alunos</h2>
            <br/>
            <!-- Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Renda Familiar</th>
                        <th>Nascimento</th>
                        <th>Idade</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($list != null) { ?>
                        <?php foreach ($list as $key) { ?>
                            <tr>
                                <td><?php echo $key->nome; ?></td>
                                <td><?php echo $key->endereco; ?></td>
                                <td><?php echo 'R$ ' . number_format($key->renda_familiar, 2, ',', '.'); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($key->data_nascimento)); ?></td>
                                <td><?php echo $key->idade; ?></td>
                                <td><img src="<?php echo base_url($key->foto); ?>" style="max-width: 50px; max-height: 50px;" /></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Nenhum aluno encontrado.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>