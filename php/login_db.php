<?php 
  session_start();
	include('conexao.php');
	if(empty($_POST['usuario']) || empty($_POST['senha'])){
		header('index.php');
		exit();
}
$usuario = $_POST['usuario'];
$senha 	 = md5($_POST['senha']);
$nivel	 = $_POST['nivel'];

$sql = "SELECT * FROM vendedores WHERE usuario = '$usuario' and senha = '$senha' and nivel = '$nivel'";
$query = mysqli_query($con, $sql);
$row = mysqli_num_rows($query);

if($row ==1){
	$item = mysqli_fetch_array($query, MYSQLI_ASSOC);
	$_SESSION['vendedores'] = $item;
	if($nivel ==0){	
	header('Location: painel_usuario.php');
	exit();	
	}else{
		$_SESSION['vendedores'] = $item;
		header('Location: painel.php');
		exit();
	}

}else{
	header('Location: login.php?erro=2');
	exit();
}



?>