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
	                <input type="text" class="form-control" name="assunto" placeholder="Assunto da menssagem" value="Atenção!" required><br>
		    		Conteúdo:
		    		<textarea class="form-control" name="message" style="width:100%;" rows="10" required autofocus></textarea>
	            </div>
	            <div align="left" class="modal-footer">
		            <button type="submit" class="btn btn-primary">Enviar <i class="fa fa-paper-plane-o"></i></button>

		            <input type=hidden name="comando" value="enviar">
		        </div>
		    </form>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
	<script src="public/bootstrap/js/bootstrap.min.js"></script>
</html>