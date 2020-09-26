
<?php require 'include/header.php'; ?>

<body>


    ​
    <main>
        ​
        <div class="container">
            <div class="row ">
                <form class="col-4 mx-auto  " method="POST" action="foncAut.php" enctype="multipart/form-data">
                    <h1>auteurs</h1>
                    <div class="form-group">
                        <label for="inputTitle">Full-name</label>
                        <input type="text" class="form-control" name="aut-name">
                    </div>
                    
                    <div class="form-group">
                        <label for="inputTitle">Email</label>
                        <input type="email" class="form-control" name="aut-email">
                    </div>
                   

                    </div>
                    <div class="form-group">
                        <label for="inputImage">image</label>
                        <input type="file" class="form-control-file" name="aut-imag">
                    </div>
                    ​
                    <button type="submit" name="ok" class="btn btn-primary">Confirmer</button>
                </form>
            </div>
        </div>
    </main>
</body>
​

</html>