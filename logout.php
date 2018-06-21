<?php
require 'bootstrap.php';
App::getAuth()->logout();
Session::getInstance()->setFlash('success','Vous êtes maintenant déconnecté');
App::redirect('accueil.php');

