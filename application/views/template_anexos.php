<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    
    <title>Gerenciador de Contatos</title>
    <?php echo link_tag("assets/css/estilo.css"); ?>
</head>
<body>
    <div id="centro">
        <h1>Nome: <?php echo $contato[0]->nome; ?></h1>
        <p>
            <a href="<?php echo base_url('contatos'); ?>">
                <input type="submit" name="voltar"  id="voltar" value="Voltar para a lista de contatos">
            </a>
        </p>

        <p>
            <strong>Telefone:</strong>
            <?php echo $contato[0]->telefone; ?>
        </p>

        <p>
            <strong>E-mail: </strong>
            <?php echo $contato[0]->email; ?>
        </p>

        <p>
            <strong>Data de Nascimento: </strong>
            <?php echo dataMySQL_to_dataBr($contato[0]->nascimento); ?>
        </p>

        <p>
            <strong>Favorito: </strong>
            <?php echo traduz_favorito($contato[0]->favorito); ?>
        </p>
        <hr>
        <h3>Anexos</h3>
        <?php if (count($anexos) > 0): ?>
            <table>
                <tr>
                    <th>Arquivo</th>
                    <th>Opções</th>
                </tr>
                <?php foreach ($anexos as $anexo): ?>
                    <tr>
                        <td><?php echo $anexo->nome; ?></td>
                        <td>
                            <a href=<?php echo base_url("uploads/" . $anexo->arquivo); ?> target="_blank">
                                Download
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <br>
        <?php else: ?>
            <p>Não há anexos para este contato</p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('contatos/adicionar_anexos'); ?>" >
            <fieldset>
                <legend>Novo anexo</legend>
                <input type="hidden" name="contato_id" value="<?php echo $contato[0]->id; ?>">
                <label>
                    <input type="file" name="userfile">
                </label>
                <br>
                <div id="botoes">
                    <input type="submit" id="gravar" value="Cadastrar">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>
    