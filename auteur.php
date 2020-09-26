
<?php require 'include/header.php'; ?>
        
        <main>
        <div style="margin: 20px auto; width:20px">
            <a class="btn btn-primary "  href="form-aut.php" name=ajouter>
                <i></i>
                Ajouter
            </a>
        </div>
        <?php
            include('connexion.php');
            $rep = $conn->query('SELECT * FROM auteur where idAuteur') ?>
            <table class="table table-bordered table-striped thead-light col-8 mx-auto my-5 ">
                <!-- table heading -->
                <thead>
                    <tr style="text-align: center">
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Avatar</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <!-- table Body -->
                <!-- first line  -->
                <tbody>
                    <form method="POST" action="foncAut.php">
                        <?php while ($ligne = $rep->fetch()) {

                        ?>
                            <tr style="text-align: center">
                                <td><?php echo $ligne['fullName'] ?></td>
                                <td><?php echo $ligne['email'] ?></td>
                                <td style="width: 220px">
                                    <div> <img style="width: 200px ;height: auto;" class="h-100 rounded" src="imgs/aut/<?php echo $ligne['avatar'] ?>" alt=""></div>
                                </td>
                                <td style="border: 0px" class="d-flex justify-content-around">
                                    <!-- Update Button  -->
                                    <div>
                                        <a href="update-auteur.php?edit=<?php echo $ligne['idAuteur'];?>"name='edit' class="btn btn-success" >
                                            <i></i>
                                            Modifier
                                        </a>
                                    </div>
                                    <!-- Delete Button  -->
                                    <div>
                                    <a href="foncAut.php?danger=<?php echo $ligne['idAuteur']; ?>" name='danger' class="btn btn-danger">delete</a>
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