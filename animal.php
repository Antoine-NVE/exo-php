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
        <h1>Animal</h1>
        <?php
        try {
            $animalId = htmlspecialchars($_POST['animal']);

            // Connexion à la base
            $connexion = new PDO('mysql:dbname=adoption;host=localhost', 'root', '');

            // On crée la requête
            $sql = "SELECT * FROM animal INNER JOIN espece ON animal.espece_id = espece.id WHERE animal.id = :id";
            $response = $connexion->prepare($sql);
            $response->bindValue(':id', $animalId);
            $response->execute();

            // On récupère les animaux
            $animal = $response->fetch();
        } catch (PDOException $e) {
            die('Une erreur est survenue : ' . $e->getMessage());
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Sexe</th>
                    <th>Nom</th>
                    <th>Date de naissance</th>
                    <th>Commentaire</th>
                    <th>Disponible</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $animal['sexe'] === '1' ? 'M' : 'F' ?></td>
                    <td><?= $animal['nom'] ?></td>
                    <td><?= $animal['date_naissance'] ?></td>
                    <td><?= $animal['commentaire'] ?></td>
                    <td><?= $animal['disponible'] === 1 ? 'Oui' : 'Non' ?></td>
                    <td><?= $animal['prix'] / 100 ?> €</td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>