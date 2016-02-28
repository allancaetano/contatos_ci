<h1>Contato: <?php echo $nome; ?></h1>

<p>
    <strong>Telefone: </strong>
    <?php echo $telefone; ?>
</p>

<p>
    <strong>E-mail: </strong>
    <?php echo $email; ?>
</p>

<p>
    <strong>Data de nascimento: </strong>
    <?php echo dataMySQL_to_dataBr($nascimento); ?>
</p>

<p>
    <strong>Favorito: </strong>
    <?php echo traduz_favorito($favorito); ?>
</p>
