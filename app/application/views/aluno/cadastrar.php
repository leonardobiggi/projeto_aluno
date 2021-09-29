<h2>Cadastro de aluno</h2>
<br/>
<div class="row">
    <div class="col-lg-12">
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
        <form name="cadastro_aluno" action="<?php echo base_url('/cadastrar'); ?>" method="POST" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Nome completo:</label>
                    <input required class="form-control" name="nome" type="text" value="" />
                </div>
                <div class="form-group">
                    <label>Endereço:</label>
                    <input required class="form-control" name="endereco" type="text" value="" />
                </div>
                <div class="form-group">
                    <label>Renda familiar:</label>
                    <input required class="form-control" min="0" name="renda_familiar" type="text" value="" />
                </div>
                <div class="form-group">
                    <label>Data de nascimento:</label>
                    <input required class="form-control" max="<?php echo date('Y-m-d'); ?>" name="data_nascimento" type="date" value="" />
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
        </form>
    </div>
</div>