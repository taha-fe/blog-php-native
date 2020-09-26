

<?php require 'include/header.php'; ?>
      
        <main>
        <div style="margin: 20px auto; width:20px">
            <a class="btn btn-primary "  href="form-cat.php" name=ajouter>
                <i></i>
                Ajouter
            </a>
        </div>
                <?php
            include ('connexion.php');
            $rep = $conn->query ('SELECT * FROM categorie where id') ?>
            <table class="table table-bordered table-striped thead-light col-8 mx-auto my-5 ">
                <!-- table heading -->
                <thead>
                    <tr style="text-align: center">
                        <th>Titre</th>
                        <th >Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- table Body -->
                <!-- first line  -->
                <tbody>
                <form method="POST" action="fonc-cat.php">
                <?php while ($ligne=$rep->fetch()){

                    ?>
                <tr>
                    <td><?php echo $ligne['nomCategorie'] ?></td>
                       <td style="width: 220px"><div > <img style="width: 200px ;height: auto;" class="h-100" src="imgs/cat/<?php echo $ligne['imgCat'] ?>" alt=""></div></td>
                 <td style="border: 0px" class="d-flex justify-content-around">
                        <!-- Update Button  -->
                        <div>
                            <a href="update-categorie.php?updateCat=<?php echo $ligne['id'];?>"name=updateCat class="btn btn-success" >
                                <i></i>
                                Modifier
                            </a>
                        </div>
                        <!-- Delete Button  -->
                        <div>
                            <a href="fonc-cat.php?delete=<?php echo $ligne['id'];?>"name='delete' class="btn btn-danger" >
                                <i></i>
                                Supprimer
                            </a>
                        </div>
                    </td>
                </tr>
                </form>
                
<?php           } ?>
                </tbody>
            </table>
        </main>
    </body>
</html>