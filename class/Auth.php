<?php
class Auth{

	private $session;
	private $options = [
		'restriction_msg' => "Page inaccessible"
	];

	public function __construct($session, $options = []){
		$this->options = array_merge($this->options, $options);
		$this->session = $session;

	}

	public function hashPassword($password){
		return password_hash($password, PASSWORD_BCRYPT);
	}


	public function register($db, $prenom, $nom ,$email ,$password, $day, $month, $year){
		$birthdate_ts=strtotime("$year-$month-$day");
		$birthdate=date("Y-m-d",$birthdate_ts);

		$password = $this->hashPassword($password);
		$token = Str::random(60);

		$db->query("INSERT INTO users SET Prénom = ?, Nom = ?, Email = ?, Password = ?, Birthdate = ?, confirmation_token = ?",[$prenom, $nom, $email, $password, $birthdate, $token]);

		$user_id = $db->lastInsertId();

		mail($email,'Confirmation de votre compte',"Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/sasa/confirm.php?id=$user_id&token=$token");

	}


	public function confirm($db, $user_id, $token){
		$user = $db->query('SELECT * FROM users WHERE ID = ? AND confirmation_token = ?',[$user_id,$token])->fetch();

		if ($user){
			$db->query('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE ID = ?',[$user_id]);
			$this->session->write('auth', $user);
			return true;
		}
		return false; 
	}
	public function confirmResetToken($db, $user_id, $token){
		$user = $db->query('SELECT * FROM users WHERE ID = ?  AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)',[$user_id, $token])->fetch();
		if ($user){			
			$db->query('UPDATE users SET reset_token = NULL, reset_at = NULL WHERE ID = ?',[$user_id]);
			return true;
		}
		return false; 
	}
	public function changeResetToken($db, $user_id, $token){
		$user = $db->query('SELECT * FROM users WHERE ID = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [$user_id, $token]);

		if ($user){
			$db->query('UPDATE users SET reset_token = NULL, reset_at = NOW() WHERE ID = ?',[$user_id]);
			return true;
		}
		return false; 
	}

	public function restrict(){
		if (!$this->session->read('auth')){
			$this->session->setFlash('danger',$this->options['restriction_msg']);
			header('Location: login.php');
			exit();
		}
	}


	public function logged_restrict(){
		if ($this->session->read('auth')){
			$this->session->setFlash('danger',$this->options['restriction_msg']);
			header('Location: accueil.php');
			exit();
		}
	}

	public function user(){
		if(!$this->session->read('auth')){
			return false;
		}
		return $this->session->read('auth');
	}

	public function connect($user){
		$this->session->write('auth',$user);
	}

	public function connectFromCookie($db){
		if(isset($_COOKIE['remember']) && !$this->user()){
			$remember_token = $_COOKIE['remember'];
			$parts = explode('==', $remember_token);
			$user_id = $parts[0];	
			$user = $db->query('SELECT * FROM users WHERE ID = ?',[$user_id])->fetch();

			if($user){
				$expected = $user_id .'=='. $user->remember_token . sha1($user_id . 'ratonlaveurs');
				if($expected == $remember_token){
					$this->connect($user);
					setcookie('remember',$remember_token, time() + 60*60*24*7);
					// header('Location: account.php');		
				}else{
					setcookie('remember', null, -1);
				}
			}else{
				setcookie('remember', null, -1);
			}
		}
	}

	public function login($db, $email, $password, $remember = false){
		$user = $db->query('SELECT * from users WHERE Email = ? AND confirmed_at IS NOT NULL',[$email])->fetch();
		if($user){
			if(password_verify($password, $user->Password)){
				$this->connect($user);
				if($remember){
					$this->remember($db, $user->ID);
				}	
				return $user;
			}else{
				return false;
			}
		}else{
		return false;
		}
	}

	public function remember($db, $user_id){
		$remember_token = Str::random(250);
		$db->query('UPDATE users SET remember_token = ? WHERE ID = ?',[$remember_token, $user_id]);
		setcookie('remember', $user_id .'=='. $remember_token . sha1($user_id . 'ratonlaveurs'), time() + 60*60*24*7);

	}

	public function logout(){
		setcookie('remember', NULL, -1);
		$this->session->delete('auth');
	}

	public function resetPassword($db, $email){
		$user = $db->query('SELECT * from users WHERE Email = ? AND confirmed_at IS NOT NULL', [$email])->fetch();
		if($user){
			$reset_token = Str::random(60);
			$db->query('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE ID = ?',[$reset_token, $user->ID]);
			
			mail($email,'Réinitialisation de votre mot de passe',"Afin de réinitialiser votre mot de passe, merci de cliquer sur ce lien\n\nhttp://localhost/sasa/confirm_reset.php?id={$user->ID}&token=$reset_token");
			return $user;

		}
		return false;
	}

}