<!DOCTYPE html>
<head>
<title>Desafio de Cadastro Sincroniza Educação</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.css">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/modernizr.js"></script>
<script src="js/jquery.cookie.js"></script>
</head>
<body class="dashboard-page">

	<section class="wrapper scrollable">
		<section class="title-bar">
			<div class="logo">
				<h1><a href="index.html"><img src="https://sincronizaeducacao.com.br/wp_sincroniza/wp-content/themes/sincroniza-theme/img/logo-sincroniza-cor@2x.png" alt="" style="width:200px;" /></a></h1>
			</div>
			
			<div class="clearfix"> </div>
		</section>
		<div class="main-grid">
			<div class="agile-grids">	
				<!-- validation -->
				<div class="grids">
					<div class="progressbar-heading grids-heading">
						<h2>Cadastro de pessoa usuária:</h2>
					</div>
					<?
					if(@$_GET['sucesso']==1)
					{
						?>
						<div class="alert alert-success" id="sucesso" role="alert">
							<strong>Cadastro concluído com sucesso!</strong>
						</div>
						<script>
							setTimeout(function() {
								$('#sucesso').fadeOut('slow');
							}, 3000);						
						</script>
						<?						
					}
					?>
					<div class="forms-grids">
						<div class="w3agile-validation">
							<div class="panel panel-widget agile-validation">
								<div class="my-div">
									<form method="post" action="gravar.php" class="valida" autocomplete="off" novalidate="novalidate">

										<label for="nome">Nome: (obrigatório)&nbsp;</label>
										<div class="form-group">
											<input type="text" name="nome" id="nome" required="true" class="form-control" data-required="Digite seu nome completo!">
										</div>

										<label for="field-2">E-mail: (obrigatório)</label>
										<div class="form-group">
											<input type="text" name="email" id="email" filter="email" class="form-control" required="true" data-invalid="Digite um E-mail válido!">
										</div>

										<label for="uf">Estado: (obrigatório)&nbsp;</label>
										<div class="form-group">
											<select name="uf" id="uf" required="true" class="form-control" data-invalid="Selecione um estado!" onchange="javascript:CarregaCidade(this.value);">
												<option value="">Selecione...</option>
											</select>
										</div>

										<label for="cidade">Cidade: (obrigatório)&nbsp;</label>
										<div class="form-group">
											<select name="cidade" id="cidade" required="true" class="form-control" data-invalid="Selecione uma cidade!" onchange="javascript:CarregaEscola(this.value);">
												<option value=""></option>
											</select>
										</div>

										<label for="escola">Escola: (obrigatório)&nbsp;</label>
										<div class="form-group">
											<select name="escola" id="escola" required="true" class="form-control" data-invalid="Selecione uma faculdade!">
												<option value=""></option>
											</select>
										</div>

										<hr>

										<p>
											<input type="submit" name="sub-1" value="Enviar" class="btn btn-primary">
											<input type="reset" name="res-1" id="res-1" value="Limpar" class="btn btn-danger">
										</p>
									</form>
								</div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<!-- //validation -->
			</div>
		</div>
		<!-- footer -->
		<div class="footer">
			<p>Sincroniza Educação</p>
		</div>
		<!-- //footer -->
	</section>
	<script src="js/bootstrap.js"></script>
	
	
	<!-- input-forms -->
		<script type="text/javascript" src="js/valida.2.1.6.min.js"></script>
		<script type="text/javascript" >

				//Carregando dropdown de UF
				function CarregaUF() 
				{
					$.ajax({
						type: "GET",
						url: "http://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome",
						contentType: "application/json; charset=utf-8",
						dataType: "json",
						success: function(data)
								{
									$.each(data, function (){
										$("#uf").append($("<option     />").val(this.sigla).text(this.nome));
									});
								},
						failure: function () {
							alert("Falha ao carregar UF!");
						}
					});
				}

				//Carregando dropdown de UF
				function CarregaCidade(uf) 
				{
					$.ajax({
						type: "GET",
						url: "http://servicodados.ibge.gov.br/api/v1/localidades/estados/"+uf+"/municipios",
						contentType: "application/json; charset=utf-8",
						dataType: "json",
						success: function(data)
								{
									document.getElementById('cidade').innerHTML="";
									$.each(data, function (){
										$("#cidade").append($("<option     />").val(this.id).text(this.nome));
									});
								},
						failure: function () {
							alert("Falha ao carregar Cidade!");
						}
					});
				}

				//Carregando dropdown de Escolas
				function CarregaEscola(cidade) 
				{
					$.ajax({
						type: "GET",
						url: "get_escolas.php?cidade="+cidade,
						contentType: "application/json; charset=utf-8",
						dataType: "json",
						success: function(data)
								{
									document.getElementById('escola').innerHTML="";
									$.each(data, function (){
									console.log(this);
									$.each(this, function (){
										$("#escola").append($("<option     />").val(this.nome).text(this.nome));
									});
									});
								},
						failure: function () {
							alert("Falha ao carregar Escola!");
						}
					});
				}


			$(document).ready(function() {

				// show Valida's version.
				$('#version').valida( 'version' );

				// Exemple 1
				$('.valida').valida();


				
				CarregaUF() ;				

			});

		</script>
		<!-- //input-forms -->
		<!--validator js-->
		<script src="js/validator.min.js"></script>
		<!--//validator js-->
<script src="js/proton.js"></script>
</body>
</html>
