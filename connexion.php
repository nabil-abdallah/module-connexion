<?php
session_start();
include_once ('connexiondb.php');

if (isset($_POST['Connexion']))
{
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    if (!empty($login) and !empty($password))
    {
        $reqlogin = $BDD->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password =?");
        $reqlogin->execute(array(
            $login,
            $password
        ));
        $loginexist = $reqlogin->rowCount();
        if ($loginexist == 1)
        {
            $logininfo = $reqlogin->fetch();
            $_SESSION['id'] = $logininfo['id'];
            $_SESSION['login'] = $logininfo['login'];
            $_SESSION['nom'] = $logininfo['nom'];
            $_SESSION['prenom'] = $logininfo['prenom'];
            header("location:index.php?id=" . $_SESSION['id']);

        }
        else
        {
            $erreur = "Login ou mot de passe incorrect !";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>connexion</title>
	<meta charset="utf-8">
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
<main>
<section>
<h2>Connexion à votre profil</h2>
<?php if (isset($erreur))
{
    echo '<font color="red">' . $erreur . '</font>';
}
?>
</section>
<form class="form" action="connexion.php" method="post">
    <section>
        <label for="Login">Login</label>
        <input type="text" id="Login" name="login"/><br>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password"/><br>
        <label for="Envoyer"></label>
        <input type="submit" name="Connexion" value="Connexion"/></br>
        <a class="button" href="inscription.php">S'inscrire !</a><br>
    </section>
</form>
</main>





</div>
</body>
</html>