<?php

class Site {


	public function header() 
	{
	    $database = new Request();
		$header = $database->query(' SELECT Id, Title, Img FROM header');
		return $header;
	}
	// Articles 
	public function articles() 
	{
	    $database = new Request();
		$articles = $database->query(
		'
			SELECT Id, Title, Content, Author, Img	, CreationDate		
			FROM articles 
			ORDER BY CreationDate DESC
		'
		);
		
		return $articles;
	}
	// Commentaires 
	public function comments() 
	{


		$database = new Request();
		$comments = $database->query(' SELECT * FROM comments ORDER BY `comments`.`DateCreation` DESC');


		
		//si il n'y a pas de saisie posté dans le formulaire
		if(!empty($_POST)) 
		{

 			// Upload Comment
			$database = new Request();
			// Update Password
			$comments = $database->execute( 
				'
			        INSERT INTO
			            comments (Articles_Id, Comm_Content, Comm_Author, Comm_Img, DateCreation )
			        VALUES
			            (?, ?, ?, ?, NOW())
			    '
				,
				[ 
					$_POST['postId'], 
					$_POST['content'], 
					$_POST['author'],
					$_SESSION['avatar']



				]  
			);

			//Redirection 
			header('Location: admin.php');
			exit();
		} 

		return $comments;
	}
	public function commandes() 
	{
	    $database = new Request();
		$commandes = $database->query(' SELECT * FROM commandes ');
		return $commandes;
	}
	
	public function category_Commandes() 
	{
	    $database = new Request();
		$category_Commandes = $database->query(' SELECT DISTINCT Category FROM commandes ');

		return $category_Commandes;
	}

}

?>