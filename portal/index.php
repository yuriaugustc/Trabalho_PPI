<?php
	session_start();
	$email = $_SESSION["email"] ?? "";

	if($email === ""){
		header("Location: ../index.html");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" href="../style/portal.css">
    <title>Anunweb - Portal</title>
</head>
<body>
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              	<a class="navbar-brand" href="index.php">
					<img src="../img/logo.png" alt="logo" height="30" width="30">
					Portal
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="../index.html">Página Inicial</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#perfil" id="perf">Perfil</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Anúncio
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="#anunCreate" id="criar">Criar novo anúncio</a></li>
						<li><a class="dropdown-item" href="#myAnuns" id="myanun">Meus anúncios</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="#anunDelete" id="anunD">Excluir anúncio</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="interesses" href="#staticBackdrop" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Mensagens de Interesse</a>
					</li>
                </ul>
				<div>
					<button type="submit" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#sair1">
						Sair
						<i class="bi bi-box-arrow-right"></i>
					</button>
				</div>
              </div>
            </div>
		</nav>
		<section id="welcome" class="text-center">
			<h3>Bem-Vindo!</h3>
			<img src="../img/logo.png" alt="logo" height="200" width="200">
		</section>
		<section id="perfil" hidden>
			<form class="row g-3" id="formAtualiz">
				<div class="col-12">
					<label for="nome1" class="form-label">Nome</label>
				  	<input type="text" name="nome" class="form-control" id="nome1" readonly>
				</div>
				<div class="col-md-6">
					<label for="cpf" class="form-label">CPF</label>
					<input type="tel" name="cpf" class="form-control" id="cpf" placeholder="xxx.xxx.xxx-xx" readonly>
				</div>
				<div class="col-md-6">
					<label for="tel" class="form-label">Telefone</label>
					<input type="tel" name="tel" class="form-control" id="tel" placeholder="(xx) 9xxxx-xxxx" readonly>
				</div>
				<div class="col-md-6">
					<label for="email" class="form-label">Email</label>
				  	<input type="email" name="email" class="form-control" id="email" readonly>
				</div>
				<div class="col-md-6">
					<label for="passw" class="form-label">Password</label>
					<input type="password" name="passw" class="form-control" id="passw" readonly>
				</div>
				<div class="col-12">
				  	<button type="button" class="btn btn-primary" id="edit-atualiz">Editar Dados</button>
				</div>
			</form>
		</section>
		<section id="anunCreate" hidden>
			<form class="row g-3" id="formAnun" enctype="multipart/form-data">
				<div class="col-12">
				  	<label for="title" class="form-label">Titulo do Anúncio</label>
				  	<input type="text" name="title" class="form-control" id="title" required>
				</div>
				<div class="col-12">
				  	<label for="description" class="form-label">Descrição</label>
				  	<textarea class="form-control" name="desc" id="description" rows="3" required></textarea>
				</div>
				<div class="col-md-8">
					<label for="categoria" class="form-label">Categoria</label>
					<select id="categoria" name="categoria" class="form-select" required>
						<option selected id="choose">Escolha...</option>
						<option id="1" value="1">Veículo</option>
						<option id="2" value="2">Eletroeletrônico</option>
						<option id="3" value="3">Imóvel</option>
						<option id="4" value="4">Móvel</option>
						<option id="5" value="5">Vestuário</option>
						<option id="6" value="6">Outro</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="price" class="form-label">Preco</label>
					<input type="text" name="price" class="form-control" id="price" required>
				</div>
				<div class="col-md-6">
					<label for="cep" class="form-label">cep</label>
					<input type="text" name="cep" class="form-control" id="cep" required pattern="\d{5}-\d{3}" title="xxxxx-xxx">
				</div>
				<div class="col-md-6">
					<label for="bairro" class="form-label">Bairro</label>
					<input type="text" name="bairro" class="form-control" id="bairro" required>
				</div>
				<div class="col-md-6">
					<label for="cidade" class="form-label">Cidade</label>
					<input type="text" name="cidade" class="form-control" id="cidade" required>
				</div>
				<div class="col-md-6">
					<label for="estado" class="form-label">Estado</label>
					<input type="text" name="estado" class="form-control" id="estado" required>
				</div>
				<div class="col-12">
					<label for="file" class="form-label">Selecione a imagem para o anúncio</label>
					<input name="srcImg" class="form-control form-control-sm" id="file" type="file" required>
				</div>
				<div class="col-12">
				  <button type="button" id="criarAnuncio" class="btn btn-primary">Criar Anúncio!</button>
				</div>
			</form>
		</section>
		<section id="myAnuns" hidden>
			<div id="my-card-list">
				<!-- Lista de anuncios -->
			</div>
		</section>
		<section id="anunDelete" hidden>
			<form class="d-flex" id="search-delete">
				<input class="form-control" type="search" id="search-s" placeholder="Busque o anuncio que deseja excluir" aria-label="Search">
				<button class="btn btn-outline-secondary" type="button" id="search-d">Buscar</button>
			</form>
			<div id="d-card-list">
				<!-- Lista de anuncios -->
			</div>
		</section>
		<section id="msgInteresse">
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Mensagens de Interesses</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body" id="modal-body">
							<div class="accordion" id="lista-interesse">
								<div class="accordion-item">
								  	<h2 class="accordion-header" id="interessado1">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
											Interessado
										</button>
								  	</h2>
									<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="interessado1" data-bs-parent="accordion">
										<div class="accordion-body">Mensagem do interessado.</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button id="closeInteresse" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="sair">
			<div class="modal fade" id="sair1" tabindex="-1" aria-labelledby="logout" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="logout">Tem certeza que deseja sair?</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
							<button type="button" id="exit" class="btn btn-primary">Sair</button>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<script src="../scripts/portal.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>