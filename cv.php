<?php

require_once "DBconn.php";

if(!isset($_POST['organization'], $_POST['qualification'], $_POST['edsince'], $_POST['edupto'])){
    exit('Empty Field(s)');
}

if(empty($_POST['organization']) || empty($_POST['qualification']) || empty($_POST['edsince']) || empty($_POST['edupto'])){
    exit('Values Empty');
}

if($stmt = $conn->prepare('INSERT INTO profxp (id_cv, occupation, employer, since, upto, organization, qualification, edsince, edupto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')){
    $stmt -> bind_param('issssssss', $_POST['idForm1'], $_POST['occupation'], $_POST['employer'], $_POST['since'], $_POST['upto'], $_POST['organization'], $_POST['qualification'], $_POST['edsince'], $_POST['edupto']);
    $stmt -> execute();
}
else{
    echo 'Error occurred';
}
$stmt->close();

?>