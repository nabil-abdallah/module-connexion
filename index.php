<?php
session_start();
include_once ('connexiondb.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet"> 
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
			 <a href="deconnexion.php">Se déconnecter</a>	
			</li>
			<li>
				<a href="profil.php">Editer profil</a>
			</li>
			<li>
				 <a href="admin.php">Espace admin</a>
			</li>
</ul>
</nav>
</header>	
<main class="intro">
<?php
echo 'Bienvenu Soldat : ' . $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
?>
</main>
<footer>
    <ul>
        <li>Connexion forever</li>
    </ul>
</footer>  
</body>
</html>
