<body>
    <h1>Gerenciador de Contatos</h1>

    <form method="post" action="<?php echo base_url('contatos/salvar_alteracao'); ?>">
        <fieldset>
            <input type="hidden" name="id" value="<?php echo $contato[0]->id; ?>">
            <legend>Novo Contato</legend>
            <label>
                Nome:
                <input type="text" name="nome" value="<?php echo $contato[0]->nome; ?>">
                <span class="erro">
                    <?php echo form_error('nome'); ?>
                </span>
            </label>
            
            <label>
                Telefone:
                <input type="text" id="telefone" name="telefone" value="<?php echo $contato[0]->telefone; ?>">
                <span class="erro">
                    <?php echo form_error('telefone'); ?>
                </span>
            </label>
            
            <label>
                E-mail:
                <input type="text" name="email" value="<?php echo $contato[0]->email; ?>">
                <span class="erro">
                    <?php echo form_error('email'); ?>
                </span>
            </label>
            
            <label>
                Data de Nascimento:
                <input type="text" id="nascimento" name="nascimento" value="<?php echo dataMySQL_to_dataBr($contato[0]->nascimento); ?>">
            </label>
            
            <label>
                Favorito:
                <input type="checkbox" name="favorito" value=1 <?php echo ($contato[0]->favorito == 1) ? 'checked' : '' ?>>
            </label>
            
            <label>
                Lembrete por e-mail:
                <input type="checkbox" name="lembrete" value=1>
            </label>
            
            <div id="botoes">
                <input type="submit" id="cancelar" name="cancelar" value="Cancelar">
                <input type="submit" id="gravar" name="atualizar" value="Atualizar">
            </div>
        </fieldset>
    </form>
    <br/> 
    
    <script type="text/javascript">
        jQuery(function ($) {
            $("#nascimento").mask("99/99/9999");
            $("#telefone").mask("(99) 9999-9999");
        });
    </script>
    