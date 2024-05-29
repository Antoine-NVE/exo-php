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
        <h1>Adoption</h1>
        <?php
        try {
            $nomCourant = htmlspecialchars($_POST['espece']);
            setcookie('espece', $nomCourant);

            // Connexion à la base
            $connexion = new PDO('mysql:dbname=adoption;host=localhost', 'root', '');

            // On crée la requête
            $sql = "SELECT animal.id, animal.nom FROM animal INNER JOIN espece ON animal.espece_id = espece.id WHERE espece.nom_courant = :nomCourant";
            $response = $connexion->prepare($sql);
            $response->bindValue(':nomCourant', $nomCourant);
            $response->execute();

            // On récupère les animaux
            $animaux = $response->fetchAll();
            // var_dump($animaux);
        } catch (PDOException $e) {
            die('Une erreur est survenue : ' . $e->getMessage());
        }
        ?>
        <form action="animal.php" method="post">
            <label for="animal">Choix de l'animal :</label>
            <select name="animal" id="animal">
                <?php foreach ($animaux as $animal) : ?>
                    <option value="<?= $animal['id'] ?>"><?= ucfirst($animal['nom']) ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit">Rechercher</button>
        </form>
    </main>
</body>

</html>