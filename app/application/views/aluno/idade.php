<h2>Relatório por idade:</h2>
<br/>
<div class="row">
    <div class="col col-lg-6">
        <!-- Form -->
        <form name="editar_aluno" action="<?php echo base_url('/lista_pdf'); ?>" method="POST" target="blank">
            
            <div class="form-group">
                <label>Idade:</label>
                <input class="form-control" name="idade" type="number" value="" />
            </div>
            <div class="form-group">
                <br/>
                <input class="btn btn-outline-primary" type="submit" value="Gerar relatório"/>
            </div>
        </form>
    </div>
</div>