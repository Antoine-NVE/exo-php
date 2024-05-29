<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Adoption</title>

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <?php include './mon-header.php' ?>
    </header>
    <main>
        <h1>Accueil</h1>
        <?php
        try {
            // Connexion à la base
            $connexion = new PDO('mysql:dbname=adoption;host=localhost', 'root', '');

            // On crée la requête
            $sql = "SELECT * FROM espece";
            $response = $connexion->prepare($sql);
            $response->execute();

            // On récupère les espèces
            $especes = $response->fetchAll();
        } catch (PDOException $e) {
            die('Une erreur est survenue : ' . $e->getMessage());
        }
        ?>
        <form action="adoption.php" method="post">
            <label for="espece">Choix de l'espèce :</label>
            <select name="espece" id="espece">


                <?php foreach ($especes as $espece) : ?>
                    <option value="<?= $espece['nom_courant'] ?>"><?= ucfirst($espece['nom_courant']) ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit">Rechercher</button>
        </form>


    </main>

</body>

</html>