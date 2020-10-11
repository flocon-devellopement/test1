<?php

class Connect {
	
	// Register 
	public function register($post) 
	{
	    // Crytpage mdp
	    $hashPwd = $this->hashPassword($post['psw']);
		// Appel de class 
		$database = new Request();
		// Execution fonction (requète)
		$database->execute(
			'	INSERT INTO users(email, psw, firstName, lastName, age, role, avatar) 
			    VALUES (?, ?, ?, ?, ?, "user", "user.png")
			',  
			[ 
				$post['email'], 
				$hashPwd, 
				$post['firstName'], 
				$post['lastName'], 
				$post['age']
			]
		);
		// Redirection
		header('Location: index.php');
		exit();
	}
	// Login 
	public function login($post) 
	{
		// Appel de class 
	    $database = new Request();
		// Execution fonction (requète)
		$user = $database->queryOne(
			'	SELECT id, email, psw, firstName, lastName, age, role, avatar 
				FROM users WHERE email =?
			', 
			[ $post['email'] ]
		);
		// Ouverture de la Session User
		if( $user !== false && $this->verifyPassword($post['psw'], $user['psw']) === true ) {
			$_SESSION['id'] = $user['id'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['firstName'] = $user['firstName'];
			$_SESSION['lastName'] = $user['lastName'];
			$_SESSION['age'] = $user['age'];
			$_SESSION['role'] = $user['role'];
			$_SESSION['avatar'] = $user['avatar'];
		}
		// Redirection
		header('Location: index.php');
		exit();
	}
	// Crypt psw
	public function hashPassword($password)
	{
	    $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);
        return crypt($password, $salt);
	}
	// Concordance psw 
	private function verifyPassword($password, $hashedPassword)
	{
	    
	    return crypt($password, $hashedPassword) == $hashedPassword;
	}
}

?>