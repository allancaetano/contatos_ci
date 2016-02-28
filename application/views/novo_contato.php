<body>
    <h1>Gerenciador de Contatos</h1>

    <form method="post" action="<?php echo base_url('contatos/adicionar_contato'); ?>">
        <fieldset>
            <legend>Novo Contato</legend>
            <label>
                Nome:
                <input type="text" name="nome" value="<?php echo set_value('nome'); ?>">
                <span class="erro">
                    <?php echo form_error('nome'); ?>
                </span>
            </label>
            
            <label>
                Telefone:
                <input type="text" id="telefone" name="telefone" value="<?php echo set_value('telefone'); ?>">
                <span class="erro">
                    <?php echo form_error('telefone'); ?>
                </span>
            </label>
            
            <label>
                E-mail:
                <input type="text" name="email" value="<?php echo set_value('email'); ?>">
                <span class="erro">
                    <?php echo form_error('email'); ?>
                </span>
            </label>
            
            <label>
                Data de Nascimento:
                <input type="text" id="nascimento" name="nascimento" value="<?php echo set_value('nascimento'); ?>">
            </label>
            
            <label>
                Favorito:
                <input type="checkbox" name="favorito" value=1>
            </label>
            
            <label>
                Lembrete por e-mail:
                <input type="checkbox" name="lembrete" value=1>
            </label>
            
            <div id="botoes">
                <input type="submit" id="gravar" name="cadastrar" value="Cadastrar">
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