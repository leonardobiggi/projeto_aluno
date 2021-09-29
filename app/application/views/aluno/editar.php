<h2>Editar aluno</h2>
<br/>
<div class="row">
    <div class="col col-lg-12">
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
        <!-- Form -->
        <form name="editar_aluno" action="<?php echo base_url('/editar/' . $aluno->id); ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="form-group">
                        <label>ID:</label>
                        <input class="form-control" disabled name="id" type="text" value="<?php echo $aluno->id; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Nome completo:</label>
                        <input required class="form-control" name="nome" type="text" value="<?php echo $aluno->nome; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input required class="form-control" name="endereco" type="text" value="<?php echo $aluno->endereco; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Renda familiar:</label>
                        <input required class="form-control" name="renda_familiar" type="text" min="0" value="<?php str_replace(',', '', $aluno->renda_familiar); echo str_replace('.', ',', $aluno->renda_familiar); ?>" />
                    </div>
                    <div class="form-group">
                        <label>Data de nascimento:</label>
                        <input required class="form-control" name="data_nascimento" max="<?php echo date('Y-m-d'); ?>" type="date" value="<?php echo $aluno->data_nascimento; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Foto: (Formatos: JPG, JPEG, PNG)</label>
                        <input accept="image/png, image/jpeg, image/png" class="form-control" name="foto" type="file" value="" />
                    </div>
                    <div class="form-group">
                        <br/>
                        <input class="btn btn-outline-primary" type="submit" value="Enviar"/>
                    </div>

                </div>
                <div class="col col-lg-6">
                    <img src="<?php echo base_url($aluno->foto); ?>" class="img-thumbnail rounded mx-auto d-block" />
                </div>
            </div>
        </form>
    </div>
</div>