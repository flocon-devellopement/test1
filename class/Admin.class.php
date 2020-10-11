<?php

class Admin 
{
	// Delete  Articles / Commandes / Header		
	public function user() 
	{
	    $database = new Request();
		$user = $database->query(' SELECT * FROM users');

		// Upload newlastName, newfirstName, newage, newMail
		if( isset($_POST['user_Role_change']) && !empty($_POST['user_Role_change']) )
		{
			// Stock new Info
			$new_Role = $_POST['user_Role_change'];
			
			// Misa à jour Info
			$database = new Request();
			// Update Info
			$maj_Role = $database->execute( 
				' UPDATE users SET role = ? WHERE id = ? ',
				 [ 
				 	$new_Role , $_GET['id'] 
				 ] 
			);
			
			// Redirection 
			header('Location: admin.php?id='.$_SESSION['id']);			
			exit();
		}
		return $user;
	}
	//  Add Header
	public function header_Post() 
	{
		// Ajouter 
		if (!empty($_POST['titleHeader']) && isset($_POST['titleHeader']) && 
			isset($_FILES['photoHeader']) && !empty($_FILES['photoHeader']['name']) )
		{
		    // Img format
			$extensionsValides = array('jpg', 'jpeg', 'gif', 'png', 'svg');
			// Img taille check 
			if($_FILES['photoHeader']['size'] <= 2097152){

				// Transformer en string, minuscule, dernière occurence (.)
				$extensionUpload = strtolower(substr(strrchr($_FILES['photoHeader']['name'], '.'), 1));
				
				// Format check 
				if(in_array($extensionUpload, $extensionsValides)) {
					
					// Definiton chemin d'enregistrement du fichier
					$chemin = "img/header/".$_POST['titleHeader'].".".$extensionUpload;
					// Stock img
					$imageHeader = $_POST['titleHeader'].".".$extensionUpload;
					// Upload fichier
					$resultat = move_uploaded_file($_FILES['photoHeader']['tmp_name'], $chemin);
				} 
			}
			
			// Insertion Commandes
			$data_Header = new Request();
			$data_Header->execute(
				'	
				 INSERT INTO header ( Title, Img) 
				 VALUES (?, ? )
				 '
				, [ $_POST['titleHeader'], $imageHeader  ]
			);

			// Redirection 
			header('Location: admin.php');
			exit();
		}
	}
	//  Add Articles
	public function articles_Post() 
	{
		// Ajouter 
		if (!empty($_POST['titleArticle']) && isset($_POST['titleArticle']) && 
			!empty($_POST['contentsArticle']) && isset($_POST['contentsArticle']) &&
			!empty($_POST['authorArticle']) && isset($_POST['authorArticle']) && 
			isset($_FILES['photoArticle']) && !empty($_FILES['photoArticle']['name']) )
		{
			
		    // Img format
			$extensionsValides = array('jpg', 'jpeg', 'gif', 'png', 'svg');
			// Img taille check 
			if($_FILES['photoArticle']['size'] <= 2097152){

				// Transformer en string, minuscule, dernière occurence (.)
				$extensionUpload = strtolower(substr(strrchr($_FILES['photoArticle']['name'], '.'), 1));
				
				// Format check 
				if(in_array($extensionUpload, $extensionsValides)) {
					
					// Definiton chemin d'enregistrement du fichier
					$chemin = "img/articles/".$_POST['titleArticle'].".".$extensionUpload;
					// Stock img
					$imageArticle = $_POST['titleArticle'].".".$extensionUpload;
					// Upload fichier
					$resultat = move_uploaded_file($_FILES['photoArticle']['tmp_name'], $chemin);
				} 
			}

			// Insertion Articles
			$data_Articles = new Request();
			$data_Articles->execute(
				'	
				 INSERT INTO articles (Title, Content, Author, Img, CreationDate) 
				 VALUES (?, ?, ?, ?, now()  ) 
				'
				, [ $_POST['titleArticle'], $_POST['contentsArticle'], $_POST['authorArticle'], 
				$imageArticle ]
			);

			// Redirection 
			header('Location: admin.php');
			exit();
		}
	}
	//  Add Commandes
	public function commandes_Post() 
	{
		// Ajouter 
		if (!empty($_POST['titleCommande']) && isset($_POST['titleCommande']) && 
			!empty($_POST['contentCommande']) && isset($_POST['contentCommande']) && 
			!empty($_POST['priceCommande']) && isset($_POST['priceCommande']) && 
			!empty($_POST['cateroryCommande']) && isset($_POST['cateroryCommande']) && 
			isset($_FILES['photoCommande']) && !empty($_FILES['photoCommande']['name']) )
		{
		    // Img format
			$extensionsValides = array('jpg', 'jpeg', 'gif', 'png', 'svg');
			// Img taille check 
			if($_FILES['photoCommande']['size'] <= 2097152){

				// Transformer en string, minuscule, dernière occurence (.)
				$extensionUpload = strtolower(substr(strrchr($_FILES['photoCommande']['name'], '.'), 1));
				
				// Format check 
				if(in_array($extensionUpload, $extensionsValides)) {
					
					// Definiton chemin d'enregistrement du fichier
					$chemin = "img/commandes/".$_POST['titleCommande'].".".$extensionUpload;
					// Stock img
					$imageCommande = $_POST['titleCommande'].".".$extensionUpload;
					// Upload fichier
					$resultat = move_uploaded_file($_FILES['photoCommande']['tmp_name'], $chemin);
				} 
			}
			
			// Insertion Commandes
			$data_Commandes = new Request();
			$data_Commandes->execute(
				'	
				 INSERT INTO commandes ( Title, Content, Img, Price, Category, CreationDate) 
				 VALUES (?, ?, ?, ?, ?, now() )
				 '
				, [ $_POST['titleCommande'], $_POST['contentCommande'], $imageCommande , $_POST['priceCommande'], $_POST['cateroryCommande'] ]
			);
			// Redirection 
			header('Location: admin.php');
			exit();
		}
	}
	// Delete  Articles / Commandes / Header
	public function delete_Post() 
	{
		// Cibler id
		if(isset($_GET['id']) AND !empty($_GET['id'])) 
		{
		// Articles id 
			$delete_Articles = htmlspecialchars($_GET['id']);
			// Insertion Articles
			$database = new Request();
			$database->execute(
				'	
				 DELETE FROM articles WHERE Id = ?
				'
				, [ $delete_Articles ]
			);

		// Commandes id
			$delete_Commandes = htmlspecialchars($_GET['id']);
			// Insertion Commandes
			$database->execute(
				'	
				 DELETE FROM commandes WHERE Id = ?				
				'
				, [ $delete_Commandes ]
			);

		// Header id   
			$delete_Header = htmlspecialchars($_GET['id']);
			// Insertion Header
			$database->execute(
				'	
				 DELETE FROM header WHERE Id = ?
				'
				, [ $delete_Header ]
			);

		// Comments id
			$delete_Comment = htmlspecialchars($_GET['id']);
			// Insertion Header
			$database->execute(
				'	
				 DELETE FROM comments WHERE Id = ?
				'
				, [ $delete_Comment ]
			);
			
		// user id
			$delete_User = htmlspecialchars($_GET['id']);
			// Insertion Commandes
			$database->execute(
				'	
				 DELETE FROM users WHERE Id = ?				
				'
				, [ $delete_User ]
			);
					
			header('Location: admin.php');
			exit();
		}
	}

}
?>