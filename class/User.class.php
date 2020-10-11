<?php

class User 
{
	//  Avatar
	public function avatar_Maj() 
	{
		// Upload New Avatar 
		if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']) ){
			// Définition taille max
		    $max_Size = 2097152;
		    // Définition types de format
		    $format_Type = array('jpg', 'jpeg', 'gif', 'png','svg');
			
			// Taille check 
			if($_FILES['avatar']['size'] <= $max_Size)
			{
				// Transformer en string, minuscule, dernière occurence (.)
				$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
					
				// Format check 
				if(in_array($extensionUpload, $format_Type)) 
				{
					// Definiton chemin d'enregistrement du fichier
					$chemin = "img/avatars/".$_SESSION['id'].".".$extensionUpload;
					// Upload fichier
					$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
					
					// Misa à jour Avatar
				    $database = new Request();
					// Update Avatar
					$profil_Img = $database->execute( 
						' 
						 UPDATE users SET avatar = :avatar WHERE id = :id 
						', 
						[ 
						 'avatar' => $_SESSION['id'].".".$extensionUpload, 'id' => $_SESSION['id']
						]
					);

					// Stock new avatar 
					$new_Avatar = $_SESSION['id'].".".$extensionUpload;
					// Affichage de l'avatar
					$_SESSION['avatar'] = $new_Avatar;

					// Redirection 
					header('Location: profil.php?id='.$_SESSION['id']);
					exit();
				} 
				// Format fail 
				else{echo("Format invalide");}	
			} 
			// Taille fail 
			else {echo( "Fichier trop volumineux");}
		}
	}

    // Nom,Prénom,Age, Mail 
	public function info_Maj() 
	{
		// Upload newlastName, newfirstName, newage, newMail
		if( isset($_POST['newlastName']) && !empty($_POST['newlastName']) ||
			isset($_POST['newfirstName']) && !empty($_POST['newfirstName']) || 
			isset($_POST['newage']) && !empty($_POST['newage']) || 
			isset($_POST['newMail']) && !empty($_POST['newMail']) )
		{
			// Stock new Info
			$newlastName = $_POST['newlastName'];
			$newfirstName = $_POST['newfirstName'];
			$newage = $_POST['newage'];
			$newMail = $_POST['newMail'];

			// Misa à jour Info
			$database = new Request();
			// Update Info
			$profil_LastName = $database->execute( 
				' UPDATE users SET lastName = ? ,firstName = ?, age = ?, email = ? WHERE id = ? ',
				 [ $newlastName, $newfirstName, $newage, $newMail, $_SESSION['id'] ] 
			);

			// Affichage de l'avatar
			$_SESSION['lastName'] = $newlastName;
			$_SESSION['firstName'] = $newfirstName;
			$_SESSION['age'] = $newage;
			$_SESSION['email'] = $newMail;

			// Redirection 
			header('Location: profil.php?id='.$_SESSION['id']);			
			exit();
		}
	}
    // Password 
	public function psw_Maj() 
	{
		// Upload Password
		if( isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND 
			isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) 
		{
			$mdp1 = $_POST['newmdp1'];
			$mdp2 = $_POST['newmdp2'];
			
			// Password égaux 
			if($mdp1 == $mdp2){

				// Crypt Password
				$database = new Connect();
				$new_Mdp = $database->hashPassword($mdp1);
				$new_Mdp2 = $database->hashPassword($mdp2);				
				
				// Misa à jour Password
				$database = new Request();
				// Update Password
				$profil_LastName = $database->execute( 
					' UPDATE users SET psw = ? WHERE id = ? '
					,
					[ $new_Mdp, $_SESSION['id'] ]
				);

				// redirection 
				header('Location: profil.php?id='.$_SESSION['id']);
				exit();
			} 
			else{
				echo("les champs ne sont pas identique !");
			}
		} 
	}

}

?>