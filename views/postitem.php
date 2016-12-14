<div class="postitem">
    <!--area do feed de noticias -->
     <!--imagem da postagem -->
	<?php if($tipo == 'foto'): ?>
	<img src="<?php echo BASE; ?>assets/images/posts/<?php echo $url; ?>" border="0" width="100%" />
	<?php endif; ?>
	<div class="postitem_texto">
             <!--texto da imagem -->
		<?php echo $texto; ?>
	</div>
	<div class="postitem_info">
             <!--nome do usuario que postou -->
		<strong>Post de:</strong> <?php echo $nome; ?>
	</div>
	<div class="postitem_botoes">
             <!--exibe quantidades de likes ao lado do botao curtir -->
		<button class="btn btn-default" onclick="curtir(this)" data-id="<?php echo $id; ?>" data-likes="<?php echo $likes; ?>" data-liked="<?php echo $liked; ?>">(<?php echo $likes; ?>) <?php echo ($liked=='0')?'Curtir':'Descurtir'; ?></button>
		<!--clica no botão de comentar a caixa aparece com esse js -->
                <button class="btn btn-default" onclick="displayComentario(this)">Comentar</button>
		<div class="postitem_comentario">
			<br/><br/>
                        <!--campo que digita o comentario -->
			<input type="text" class="postitem_txt form-control" />
                         <!--id do comentario, js comentar que é ação de envio -->
			<button class="btn btn-default" data-id="<?php echo $id; ?>" onclick="comentar(this)">Enviar</button>
		</div>
	</div>
         
	<div class="postitem_comentarios">
		
	</div>
</div>