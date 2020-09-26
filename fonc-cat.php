<?php
require 'connexion.php';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strtolower($data);
    return $data;
}
$categoryName = $categoryImage = '';
if(isset($_POST['ajouter'])) {
    // uploading category image 
        $myFile = $_FILES['cat-img'];
        $myFileName = $_FILES['cat-img']['name'];
        $myFileTmpName = $_FILES['cat-img']['tmp_name'];
        $myFileSize = $_FILES['cat-img']['size'];
        $myFileError = $_FILES['cat-img']['error'];
        $myFileType = $_FILES['cat-img']['type'];
        global $myFileNewName;
        global $myFileDestination;
        $fileExt = explode('.', $myFileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt, $allowedExt)) {
            if($myFileError === 0) {
                if($myFileSize < 5000000) {
                    $myFileNewName = "ImgCat_" . uniqid('', true) . "." . $fileActualExt;
                    $myFileDestination = 'imgs/cat/' . $myFileNewName;
                    move_uploaded_file($myFileTmpName, $myFileDestination);
                    // header("Location: FileUploadTesting.php?uploadsuccess");
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "there was an error uploading your file";
            }
        } else {
            echo "this file type is not allowed !";
        }
        $categoryImage = $myFileNewName;
        $categoryName = test_input($_POST['cat-title']);
        $insertCategoryQuery = "INSERT INTO categorie(nomCategorie, imgCat) VALUES (\"$categoryName\", \"$categoryImage\");";
        $prp = $conn-> prepare($insertCategoryQuery);
        $prp->execute();
        echo "New record created successfully";
        header("Location: cat.php");
        }
// READ CATEGORIES FROM DATA BASE 


//**********************update*********************/


if(isset($_POST['update'])) {
    // update category image 
        $myFile = $_FILES['cat-img'];
        $myFileName = $_FILES['cat-img']['name'];
        $myFileTmpName = $_FILES['cat-img']['tmp_name'];
        $myFileSize = $_FILES['cat-img']['size'];
        $myFileError = $_FILES['cat-img']['error'];
        $myFileType = $_FILES['cat-img']['type'];
        global $myFileNewName;
        global $myFileDestination;
        $fileExt = explode('.', $myFileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt, $allowedExt)) {
            if($myFileError === 0) {
                if($myFileSize < 5000000) {
                    $myFileNewName = "ImgCat_" . uniqid('', true) . "." . $fileActualExt;
                    $myFileDestination = 'imgs/cat/' . $myFileNewName;
                    move_uploaded_file($myFileTmpName, $myFileDestination);
                    // header("Location: FileUploadTesting.php?uploadsuccess");
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "there was an error uploading your file";
            }
        } else {
            echo "this file type is not allowed !";
        }
        

       
        
        $categoryName = test_input($_POST['cat-name']);
        echo $categoryName;
        $oldimgCat= test_input($_POST['old-imgCat']);
        $id= test_input($_POST['id-categorie']);
        if ($myFileError){
            $categoryImage= $oldimgCat;
        }else{
            $categoryImage= $myFileNewName;
        }





        $insertCategoryQuery = "UPDATE categorie SET nomCategorie=?, imgCat=? WHERE id= ?";
        $prp = $conn-> prepare($insertCategoryQuery);
        $prp->execute([$categoryName,$categoryImage,$id]);
        echo "New record created successfully";
        header("Location: cat.php");


    }




    //*************delete ****************************/

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try{
    $sql=("DELETE FROM `categorie` WHERE id=$id");
    $conn->exec($sql);
        
    echo "deleted";
    
    }catch(PDOException $e){
        echo $e;
    } 
     header('refresh:1 url=cat.php');
}
?>