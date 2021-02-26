<?php

/**
 * Pour cet exercice, vous allez utiliser la base de données table_test_php créée pendant l'exo 189
 * Vous utiliserez également les deux tables que vous aviez créées au point 2 ( créer des tables avec PHP )
 */

/**
 * Créez ici votre objet de connection PDO, et utilisez à chaque fois le même objet $pdo ici.
 */
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'table_test_phpmyadmin';

try {
    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'conection OK !!<br>';

    /**
     * 1. Insérez un nouvel utilisateur dans la table utilisateur.
     */

    // TODO votre code ici.

    $dt = new DateTime();
    $date = $dt->format('Y-m-d H:i:s');

    $create = "
    INSERT INTO utilisateur(nom,prenom,email,password,adresse,code_postal,pays,date_join)
    VALUES ('dark','vador','deathstar@espace.univers','54556','etoile noire ch1','01000','espace intergalactique', '25/02/21')
";

    $action = $pdo->exec($create);
    echo "nouveaux utilisateur cree : " . $action . '<br>';

    /**
     * 2. Insérez un nouveau produit dans la table produit
     */

    // TODO votre code ici.

    $createProd = "
    INSERT INTO produit(titre,prix,description_courte,description_longue)
    VALUES ('blaster','1500','blaster ayant appatenue a un storm trooper de la 501em',
            'En bon etat general quelques rayure de peinture lui donne un aspect plus combattant livrer avec son support et son kit nettoyage')
";

    $action2 = $pdo->exec($createProd);
    echo "nouveaux objet cree : " . $action2 . '<br>';

    /**
     * 3. En une seule requête, ajoutez deux nouveaux utilisateurs à la table utilisateur.
     */

    // TODO Votre code ici.

    $insertuser = "
    INSERT INTO utilisateur(nom,prenom,email,password,adresse,code_postal,pays,date_join) 
    VALUES ('solo','han','hSolo@espace.univers','68541','la cantinna,coruscant','89895','coruscant','25/02/21'),
           ('skywalker','luke','skyman@espace.univers','02156','tatoinne','26548','tatoinne','25/02/21')
";

    $action3 = $pdo->exec($insertuser);
    echo "nouveaux utilisateur cree : " . $action3 . '<br>';

    /**
     * 4. En une seule requête, ajoutez deux produits à la table produit.
     */

    // TODO Votre code ici.

    $insertprod = "
    INSERT INTO produit(titre,prix,description_courte,description_longue)
    VALUES ('sabre laser','2500','un sabre laser peut servit','un sabre laser de couleur bleu tres peu servit cree juste avant execution de ordre 66'),
           ('cuir de banta','50','du cuir de premiere qualite','un cuir souple pouvant servir a la confection de ceinture ou besace')     
";

    $action4 = $pdo->exec($insertprod);
    echo "nouveaux objet cree : " . $action4 . '<br>';


    /**
     * 5. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux utilisateurs dans la table utilisateur.
     */

    // TODO Votre code ici.
    $pdo->beginTransaction();
    $insert3 = 'INSERT INTO utilisateur(nom,prenom,email,password,adresse,code_postal,pays,date_join) VALUES ';
    $request1 = $insert3 . "('organa','leia','leyaO@espace.univers','55544','palais royal','60489','naboo','25/02/21')";
    $pdo->exec($request1);
    $request2 = $insert3 . "('maitre','Yoda','Myoda@espace.univers','35489','dagobah','32648','dagobah','25/02/21')";
    $pdo->exec($request2);
    $request3 = $insert3 . "('windu','Mace','MacWin@espace.univers','01578','palais des jedi','45963','coruscant','25/02/21')";
    $pdo->exec($request3);

    $pdo->commit();
    echo "requete begin ok !! <br>";


    /**
     * 6. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux produits dans la table produit.
     */

    $pdo->beginTransaction();
    $insert4 = 'INSERT INTO produit(titre,prix,description_courte,description_longue) VALUES ';
    $request4 = $insert4 . "('ration de survie','20','ration de base','les ration de base du parfait voyageur livrer avec un rechaud depliant')";
    $pdo->exec($request4);
    $request5 = $insert4 . "('boisson energisante','20','une boisson surbooster','vous avez soudain envie de casser du stormtrooper')";
    $pdo->exec($request5);
    $request6 = $insert4 . "('crystal kibber','100000','un crystal pur de couleur mauve','les crystaux kibber sont un element important dans la fabrication de sabre laser')";
    $pdo->exec($request6);

    $pdo->commit();
    echo "requete begin ok !! <br>";


} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage() . "<br>";
    $pdo->rollBack();
}