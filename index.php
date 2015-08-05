<!DOCTYPE html>
<html>
<?php
	include('layouts/head.php');
	include('public/conexao.php');

	#pega informações dos grupos de email
	$sql_gruposemail = "SELECT codgrupoemail, grupoemail FROM gruposemail ORDER BY grupoemail ASC";
	$cons_gruposemail = pg_query($sql_gruposemail);
?>
<body>
	<div class="row">
		<div class="col-md-4">
			<p><br></p>
		</div>

		<div class="col-md-4">
			<form action="dados_sql.php" method="post" value="enviar">
	            <div class="form-group">
	            	<div class="alert alert-success" role="alert">
			    		Escreva o conteúdo do seu email abaixo
			    	</div>
			    	Selecione o grupo: 
			    	<select class="form-control" name="codgrupoemail">
				     <?
				     while ($gruposemail=pg_fetch_object($cons_gruposemail))
				     {
				        echo "<option ";
				        echo " value=$gruposemail->codgrupoemail>$gruposemail->grupoemail</option>";
				     }
				     ?>
				     </select>
	                <br>
	                Assunto: 
	                <input type="text" class="form-control" name="assunto" placeholder="Assunto da menssagem" value="Proesc, gestão educacional simples e grátis para sua escola" required><br>
		    		Conteúdo:
		    		<textarea class="form-control" name="message" style="width:100%;" rows="10" required autofocus></textarea>
	            </div>
	            <div align="left" class="modal-footer">
		            <button type="submit" class="btn btn-primary">Enviar <i class="fa fa-paper-plane-o"></i></button>

		            <input type=hidden name="comando" value="enviar">
		        </div>
		    </form>
		    <?php
		    if(!empty($envio)){ 
		    	$sql_exibe_grupo = "SELECT grupoemail, descricao FROM gruposemail WHERE codgrupoemail=$envio";
		    	$cons_exibe_grupo = pg_query($sql_exibe_grupo);
		    	$exibe_grupo = pg_fetch_object($cons_exibe_grupo);

		    	$sql_lista_sim = "SELECT enviado FROM email WHERE codgrupoemail=$envio AND enviado='s'";
		    	$cons_lista_sim = pg_query($sql_lista_sim);
		    	$sim = pg_num_rows($cons_lista_sim);

		    	$sql_lista_nao = "SELECT enviado FROM email WHERE codgrupoemail=$envio AND enviado='n'";
		    	$cons_lista_nao = pg_query($sql_lista_nao);
		    	$nao = pg_num_rows($cons_lista_nao);

		    	$total = $sim + $nao;
		    ?>
		    <div class="alert alert-info" role="alert">
			    O grupo <b><?php echo $exibe_grupo->grupoemail;?></b> possui  <b><?php echo $total;?> email's cadastrados</b>:<br>
			    Enviados: <span class="verde" id="verde"><?php echo $sim;?></span>  
			    Falta enviar: <span class="vermelho" id="vermelho"><?php echo $nao;?></span>
		    </div>
		    <?php
			}
		    ?>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
	<script src="public/bootstrap/js/bootstrap.min.js"></script>
</html>
