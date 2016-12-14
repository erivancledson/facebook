<!--pagina inicial do usuario com as informaçoes e açoes -->

<div class="row">
	<div class="col-sm-8">
<!-- area de postagem-->
		<div class="post_area">
			<form method="POST" enctype="multipart/form-data">
				<h4>O que você está pensando?</h4>
				<textarea name="post" class="form-control"></textarea><br/>
				<input type="file" name="foto" /><br/>
				<input type="submit" value="Enviar" class="btn btn-default" />
			</form>
		</div>
		<div class="feed">
                    <!-- feed de noticias-->
			<?php
			foreach($feed as $postitem) {
                            //carrega o view positem
				$this->loadView('postitem', $postitem);
			}
			?>
		</div>
	</div>
	<div class="col-sm-4">
            <!-- requisiçoes de amizades para o usuario aceitar-->
		<!-- só aparece quando tem requisiçoes-->
                <?php if(count($requisicoes) > 0): ?>
		<div class="widget">
			<h4>Requisições de amizade</h4>
			<?php foreach($requisicoes as $pessoa): ?>
			<div class="requisicaoitem">
				<strong><?php echo $pessoa['nome']; ?></strong>
				<button class="btn btn-default pull-right" onclick="aceitarFriend('<?php echo $pessoa['id']; ?>', this)">+</button>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
                   <!-- total de amigos-->
		<div class="widget">
			<h4>Total de Amigos</h4>
			<?php echo $totalamigos; ?> amigo<?php echo ($totalamigos == '1')?'':'s'; ?>
		</div>
              <!-- sugestoes de pessoas-->
                <!-- quando não tem mais amigos-->
		<?php if(count($sugestoes) > 0): ?>
		<div class="widget">
			<h4>Sugestões de amigos</h4>
			<?php foreach($sugestoes as $pessoa): ?>
			<div class="sugestaoitem">
				<strong><?php echo $pessoa['nome']; ?></strong>
                                <!--botao adicionar-->
				<button class="btn btn-default pull-right" onclick="addFriend('<?php echo $pessoa['id']; ?>', this)">+</button>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
                  
		<div class="widget">
			<h4>Grupos</h4>
                        <!-- criar grupo grupo-->
			<form method="POST">
				<div class="input-group">
					<input type="text" name="grupo" class="form-control" placeholder="Nome do grupo" />
					<span class="input-group-btn">
						<input type="submit" value="Criar" class="btn btn-default" />
					</span>
				</div>
			</form>
                        <!-- exibe os grupos, e o link para eu entrar no meu grupo-->
			<?php foreach($grupos as $grupo): ?>
			<a href="<?php echo BASE; ?>grupos/abrir/<?php echo $grupo['id']; ?>"><?php echo $grupo['titulo']; ?></a>
			<?php endforeach; ?>
		</div>
	</div>
</div>