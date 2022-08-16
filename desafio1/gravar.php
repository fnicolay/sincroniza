<?php
$servername = "localhost";
$username = "m7com748_geral";
$password = "xptonova";
$dbname = "m7com748_sincroniza";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Falha ao conctar com banco de dados: " . $conn->connect_error);
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://servicodados.ibge.gov.br/api/v1/localidades/municipios/'.@$_POST['cidade'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$cidade=json_decode($response,true);

$sql = "INSERT INTO usuarios (nome, email, uf,id_cidade,cidade,escola)
VALUES ('".@$_POST['nome']."', '".@$_POST['email']."', '".@$_POST['uf']."','".@$_POST['cidade']."','".utf8_decode($cidade['nome'])."','".@$_POST['escola']."')";
$conn->query($sql);

$conn->close();
?>
<script>window.location="index.php?sucesso=1";</script>