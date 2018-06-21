<?php 
require 'bootstrap.php';
/*unlogged_only(); A REMTTRE
*/
?>

<?php
/*require 'class/Database.php';
require 'class/App.php';*/
/*$db = App::getDatabase();
$user = $db->query('SELECT * FROM users')->fetchAll();
var_dump($user);
die();*/
App::getAuth()->logged_restrict();

if (!empty($_POST)){
	$errors = array();
	$db = App::getDatabase();
	$validator = new Validator($_POST);
	$validator->isNotNumber('prenom','Prénom invalide');
	$validator->isNotNumber('nom','Nom invalide');
	$validator->isEmail('email','Email invalide');
	if($validator->isValid()){
		$validator->isUniq('email', $db,'users','Email déjà utilisé');

	}
	$validator->isConfirmed('password','Mot de passe invalide');
	$validator->isDate('birthdate','day','month','year',"Date invalide");

	

	if($validator->isValid()){
		App::getAuth()->register($db, $_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['password'],$_POST['day'],$_POST['month'],$_POST['year']);
		/*$year = $_POST['year'];
		$month = $_POST['month'];
		$day = $_POST['day'];
		$birthdate_ts=strtotime("$year-$month-$day");
		$birthdate=date("Y-m-d",$birthdate_ts);

		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$token = str_random(60);

		$db->query("INSERT INTO users SET Prénom = ?, Nom = ?, Email = ?, Password = ?, Birthdate = ?, confirmation_token = ?",[$_POST['prenom'], $_POST['nom'], $_POST['email'], $password, $birthdate, $token]);
		$user_id = $db->lastInsertId();
		mail($_POST['email'],'Confirmation de votre compte',"Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/sasa/confirm.php?id=$user_id&token=$token");*/
		Session::getInstance()->setFlash('success','Un email de confirmation vous a été envoyé pour valider votre compte.');
		App::redirect('accueil.php');
		/*$_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte.';*/	
		/*header('Location: accueil.php');
		exit();
*/	}else{
		$errors = $validator->getErrors();
	}
}

?>

<?php require 'header.php'; ?>

<!-- Contact -->
			<section id="contact" class="main style3 secondary">
				<div class="content">
					<header class="aboveform">
						<h2>Créer un compte</h2>
						<p>Pour avoir accès aux ...</p>
					</header>

					<?php if(!empty($errors)): ?>
					<div class="alert-danger">
						<p>Formulaire incomplet:</p>
						<ul>
							<?php foreach ($errors as $error): ?> 
								<li> <?= $error; ?></li>
							<?php endforeach; ?>
						</ul>
					</div> 
					<?php endif; ?>

					<div class="box">
						<form id ="inscription" method="post" action="">
							<div class="field half first"><input type="text" name="prenom" placeholder="Prénom"  required/></div>
							<div class="field half"><input type="text" name="nom" placeholder="Nom"  required /></div>
							
							<div class="field"><input type="email" name="email" placeholder="Email"  required/></div>

							<div class="field"><input type="password" name="password" placeholder="Mot de Passe" required/></div>
							<div class="field"><input type="password" name="password_confirm" placeholder="Confirmer votre Mot de Passe" required/></div>

							
							<div class="field quarter first"><select name="day" class="minimal">
								<option selected="selected" value="0">jour</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select>
							</div>
							<div class="field half first"><select name="month" class="minimal">
								<option selected="selected" value="0">Mois</option>
								<option value="1">janvier</option>
								<option value="2">f&#233;vrier</option>
								<option value="3">mars</option>
								<option value="4">avril</option>
								<option value="5">mai</option>
								<option value="6">juin</option>
								<option value="7">juillet</option>
								<option value="8">ao&#251;t</option>
								<option value="9">septembre</option>
								<option value="10">octobre</option>
								<option value="11">novembre</option>
								<option value="12">d&#233;cembre</option>
							</select>
							</div>
							<div class="field quarter"><select name="year" class="minimal">
								<option selected="selected" value="0">Année</option>
								<option value="2002">2002</option>
								<option value="2001">2001</option>
								<option value="2000">2000</option>
								<option value="1999">1999</option>
								<option value="1998">1998</option>
								<option value="1997">1997</option>
								<option value="1996">1996</option>
								<option value="1995">1995</option>
								<option value="1994">1994</option>
								<option value="1993">1993</option>
								<option value="1992">1992</option>
								<option value="1991">1991</option>
								<option value="1990">1990</option>
								<option value="1989">1989</option>
								<option value="1988">1988</option>
								<option value="1987">1987</option>
								<option value="1986">1986</option>
								<option value="1985">1985</option>
								<option value="1984">1984</option>
								<option value="1983">1983</option>
								<option value="1982">1982</option>
								<option value="1981">1981</option>
								<option value="1980">1980</option>
								<option value="1979">1979</option>
								<option value="1978">1978</option>
								<option value="1977">1977</option>
								<option value="1976">1976</option>
								<option value="1975">1975</option>
								<option value="1974">1974</option>
								<option value="1973">1973</option>
								<option value="1972">1972</option>
								<option value="1971">1971</option>
								<option value="1970">1970</option>
								<option value="1969">1969</option>
								<option value="1968">1968</option>
								<option value="1967">1967</option>
								<option value="1966">1966</option>
								<option value="1965">1965</option>
								<option value="1964">1964</option>
								<option value="1963">1963</option>
								<option value="1962">1962</option>
								<option value="1961">1961</option>
								<option value="1960">1960</option>
								<option value="1959">1959</option>
								<option value="1958">1958</option>
								<option value="1957">1957</option>
								<option value="1956">1956</option>
								<option value="1955">1955</option>
								<option value="1954">1954</option>
								<option value="1953">1953</option>
								<option value="1952">1952</option>
								<option value="1951">1951</option>
								<option value="1950">1950</option>
								<option value="1949">1949</option>
								<option value="1948">1948</option>
								<option value="1947">1947</option>
								<option value="1946">1946</option>
								<option value="1945">1945</option>
								<option value="1944">1944</option>
								<option value="1943">1943</option>
								<option value="1942">1942</option>
								<option value="1941">1941</option>
								<option value="1940">1940</option>
								<option value="1939">1939</option>
								<option value="1938">1938</option>
								<option value="1937">1937</option>
								<option value="1936">1936</option>
								<option value="1935">1935</option>
								<option value="1934">1934</option>
								<option value="1933">1933</option>
								<option value="1932">1932</option>
								<option value="1931">1931</option>
								<option value="1930">1930</option>
								<option value="1929">1929</option>
								<option value="1928">1928</option>
								<option value="1927">1927</option>
								<option value="1926">1926</option>
								<option value="1925">1925</option>
								<option value="1924">1924</option>
								<option value="1923">1923</option>
								<option value="1922">1922</option>
								<option value="1921">1921</option>
								<option value="1920">1920</option>
								<option value="1919">1919</option>
								<option value="1918">1918</option>
								<option value="1917">1917</option>
								<option value="1916">1916</option>
								<option value="1915">1915</option>
								<option value="1914">1914</option>
								<option value="1913">1913</option>
								<option value="1912">1912</option>
								<option value="1911">1911</option>
								<option value="1910">1910</option>
								<option value="1909">1909</option>
								<option value="1908">1908</option>
								<option value="1907">1907</option>
								<option value="1906">1906</option>
								<option value="1905">1905</option>
								<option value="1904">1904</option>
								<option value="1903">1903</option>
								<option value="1902">1902</option>
								<option value="1901">1901</option>
								<option value="1900">1900</option>

							</select>
							</div>
							<div class="field"><input type="checkbox" name="remember" value="1"/>Inscrivez-vous pour recevoir par e-mail toutes les dernières actualités de Krypton.</div>
							<ul class="actions" href="#">
								<li><input type="submit" value="Rejoindre sasa.com" /></li>
							</ul>
							<p id="confid">En créant votre compte, vous acceptez nos termes et conditions &amp; politique de confidentialité</p>
						</form>
					</div>
				</div>
			</section>

<?php require 'footer.php'; ?>
