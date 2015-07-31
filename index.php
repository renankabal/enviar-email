<!DOCTYPE html>
<html>
<?php
	include('layouts/head.php');
	include('public/conexao.php');

	#pega informações dos grupos de email
	$sql_gruposemail = "SELECT codgrupoemail, grupoemail FROM gruposemail WHERE codgrupoemail=3 ORDER BY grupoemail ASC";
	$cons_gruposemail = pg_query($sql_gruposemail);
?>
<body>
	<div class="row">
		<div class="col-md-4">
			<p><br></p>
		</div>

		<div class="col-md-4">
			<form action="dados_sql.php" enctype="multipart/form-data" method="post"> 
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
			    	<textarea class="form-control" name="conteudo" style="width:100%;" rows="10" required autofocus></textarea>
			  	</div>
			  		<button type="submit" class="btn btn-primary">Enviar <i class="fa fa-paper-plane-o"></i></button>
			</form>
		</div>

		<div class="col-md-4"></div>
	</div>
</body>
	<script src="public/bootstrap/js/bootstrap.min.js"></script>
</html>