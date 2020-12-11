<?php
include_once ('connexiondb.php');

if (isset($_POST['Inscription']))
{
	if (!empty($_POST['login']) and !empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['password']) and !empty($_POST['passwordconfirm']))
	{
		$login = htmlspecialchars($_POST['login']);
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$password = htmlspecialchars($_POST['password']);
		$password2 = htmlspecialchars($_POST['passwordconfirm']);

		$loginlength = strlen($login);
		if ($loginlength <= 30)
		{
			$reqlogin = $BDD->prepare("SELECT * FROM utilisateurs WHERE login = ?");
			$reqlogin->execute(array(
				$login
			));
			$loginexist = $reqlogin->rowCount();
			if ($loginexist == 0)
			{

				if ($password == $password2)
				{
					$insertmbr = $BDD->prepare("INSERT INTO utilisateurs(login, nom, prenom, password) VALUES (?,?,?,?)");
					$insertmbr->execute(array(
						$login,
						$nom,
						$prenom,
						$password
					));
					header('location: connexion.php');
				}
				else
				{
					$erreur = "Vos mots de passes ne coresspondent pas !";
				}
			}
			else
			{
				$erreur = "Login déjà pris !";
			}
		}
		else
		{
			$erreur = "Votre Login ne doit pas dépasser 30 caractères !";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent être complétés !";
	}
}

?>

<!DOCTYPE html>
<html lang=fr>
<head>
	<title>inscription</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/Style.css">
</head>
<body>
	<header>
		<h1>
			TSFteam
		</h1>		
		<!-- menu navigation -->
		<nav class="menu-nav">
			<ul class="boutton">
				<li>
					<a 
					href="index.php">
					accueil
				</a>		
			</li>
			<li>
				<a 
				href="inscription.php"
				>
				inscription
			</a>
		</li>
		<li>
			<a href="connexion.php"
			>connexion
		</a>
	</li>	
</ul>
</nav>	
<div id=" forget">
</div>	
</header>
<main class="form">
	<section >
		<h2>Inscription</h2>
	</section>
	<?php if (isset($erreur))
{
    echo '<font color="red">' . $erreur . '</font>';
}
?>
<form action="inscription.php" method="post">
  <div>
  <table>
  	<tr>
  		<section class="form" > 
      <label for="login">Login</label>
      <input type="text" id="login" name="login"/><br>
      <label for="nom">Nom</label>
      <input type="text" id="nom" name="nom"/><br>
      <label for="prenom">Prenom</label>
      <input type="text" id="prenom" name="prenom"/><br>
      <label for="email">Votre email</label>
      <input type="texte" id="email" name="email"/><br>
      <label for="emailconfirm">Ressaisissez votre email</label>
      <input type="texte" id="emailconfirm" name="emailconfirm"/><br>
      <label for="password">Votre mot de passe</label>
      <input type="password" id="password" name="password"/><br>
      <label for="passwordconfirm">Ressaisissez votre mot de passe</label>
      <input type="password" id="passwordconfirm" name="passwordconfirm"/><br>
      <label for="sexe">Sexe :</label><input type="radio" name="sexe" id="sexe" />Homme <input type="radio" name="sexe" />Femme<br />
      <input type="submit" name="Inscription" value="Valider"/></br>
   </section>
  	</tr>
  </table>
  </div>
  
</form>



</body>
</html>