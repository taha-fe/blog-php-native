<?php require 'include/header.php'; ?>

        <main>
        <div style="margin: 20px auto; width:20px">
            <a class="btn btn-primary "  href="form-art.php" name=ajouter>
                <i></i>
                Ajouter
            </a>
        </div>
            <?php
            include('connexion.php');
            $rep = $conn->query('SELECT * FROM article INNER JOIN categorie ON  article.idCategorie = categorie.id   INNER JOIN auteur ON  article.idAuteur =  auteur.idAuteur order by dateArt desc') ?>
            <table class="table table-bordered table-striped thead-light col-8 mx-auto my-5 ">
                <!-- table heading -->
                <thead>
                    <tr style="text-align: center">
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Image</th>
                        <th>Date de modifcation</th>
                        <th>Categorie</th>
                        <th>Auteur</th>                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- table Body -->
                <!-- first line  -->
                <tbody>
                    <form method="POST" action="fonc-art.php">
                        <?php while ($ligne = $rep->fetch()) {

                        ?>
                            <tr>
                                <td><?php echo $ligne['title'] ?></td>
                                <td><?php echo substr(  $ligne['contenu'],0,100 );?></td>
                                <td>
                                <div style="height:100px;width:100px;"> <img style="width:100%;"class="h-100" src="imgs/art/<?php echo $ligne['imageArt'] ?>" alt=""></div>
                                </td>
                                <td><?php echo $ligne['dateArt'] ?></td>
                                <td><?php echo $ligne['nomCategorie'] ?></td>
                                <td><?php echo $ligne['fullName'] ?></td>
                                <td style="border: 0px" class="d-flex justify-content-around">
                                    <!-- Update Button  -->
                                    <div>
                                        <a href="updatearticle.php?edit=<?php echo $ligne['idArt'];?>"name='edit' class="btn btn-success" >
                                            <i></i>
                                            Modifier
                                        </a>
                                    </div>
                                    <!-- Delete Button  -->
                                    <div>
                                    <a href="fonc-art.php?danger=<?php echo $ligne['idArt']; ?>" name='danger' class="btn btn-danger">delete</a>
                                    </div>
                                </td>
                            </tr>
                    </form>
                <?php           } ?>

                </tbody>
                <!-- second line  -->


            </table>
        </main>
    </body>

</html>