<h2>Lista de alunos</h2>
<br/>
<div class="row">
    <div class="col col-lg-12">
        <form action="<?php echo base_url('pesquisar'); ?>" method="GET">
            <div class="row">
                <div class="col col-lg-1">
                    Nome:
                </div>
                <div class="col col-lg-9">
                    <input type="text" name="nome" minlength="1" class="form-control">
                </div>
                <div class="col col-lg-2">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Alert -->    
<?php
switch ($this->session->userdata('alert')) {
    case "alert-success":
        echo '<div class="alert alert-success alert-dismissable">' .
        $this->session->userdata('message')
        . '</div>';
        break;
    case "alert-danger":
        echo '<div class="alert alert-danger alert-dismissable">' .
        $this->session->userdata('message')
        . '</div>';
        break;
}
if ($this->session->userdata('alert') != NULL) {
    $data['result'] = array('alert' => NULL);
    $this->session->set_userdata($data['result']);
}
?>

<!-- Table -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Renda Familiar</th>
            <th>Nascimento</th>
            <th>Idade</th>
            <th>Ação</th>
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
                    <td>
                        <a href="<?php echo base_url('/editar/' . $key->id); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>
                        &nbsp;
                        <a href="<?php echo base_url('/excluir/' . $key->id); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" style="text-align: center;">Nenhum aluno cadastrado.</td>
            </tr>
        <?php } ?>
    </tbody>
</table>