<?php
$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];
$birthdate_ts=strtotime("$year-$month-$day");
$birthdate=date("Y-m-d",$birthdate_ts);
$bdd = new PDO('mysql:host=localhost;dbname=website1;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$requete = $bdd->prepare('INSERT INTO users(Prénom, Nom, Email, Password, Birthdate) VALUES(?,?,?,?,?)');
$requete->execute(array($_POST['prenom'], $_POST['nom'],$_POST['email'],$_POST['password'],$birthdate));

?>