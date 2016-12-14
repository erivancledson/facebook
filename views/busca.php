<h1>Busca</h1>
<!--resultado da busca -->
<?php foreach($resultado as $pessoa): ?>
<div class="sugestaoitem">
	<strong><?php echo $pessoa['nome']; ?></strong>
        <!--botão solicitar amizade -->
	<button class="btn btn-default pull-right" onclick="addFriend('<?php echo $pessoa['id']; ?>', this)">+</button>
</div>
<?php endforeach; ?>