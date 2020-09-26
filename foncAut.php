<?php require 'connexion.php';?>
<?php



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strtolower($data);
    return $data;
}
$auteurName = $auteurEmail = $auteurImage = '';
if(isset($_POST['ok'])) {
    // uploading category image 
        $myFile = $_FILES['aut-imag'];
        $myFileName = $_FILES['aut-imag']['name'];
        $myFileTmpName = $_FILES['aut-imag']['tmp_name'];
        $myFileSize = $_FILES['aut-imag']['size'];
        $myFileError = $_FILES['aut-imag']['error'];
        $myFileType = $_FILES['aut-imag']['type'];
        global $myFileNewName;
        global $myFileDestination;
        $fileExt = explode('.', $myFileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt, $allowedExt)) {
            if($myFileError === 0) {
                if($myFileSize < 5000000) {
                    $myFileNewName = "ImgAut_" . uniqid('', true) . "." . $fileActualExt;
                    $myFileDestination = 'imgs/Aut/' . $myFileNewName;
                    move_uploaded_file($myFileTmpName, $myFileDestination);
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "there was an error uploading your file";
            }
        } else {
            echo "this file type is not allowed !";
        }
        $auteurImage = $myFileNewName;
        $auteurName = test_input($_POST['aut-name']);
        $auteurEmail = test_input($_POST['aut-email']);
        
        $insertCategoryQuery = "INSERT INTO auteur(fullName, email, avatar) VALUES (\"$auteurName\", \"$auteurEmail\", \"$auteurImage\" );";
        $prp = $conn-> prepare($insertCategoryQuery);
        $prp->execute();
        echo "New record created successfully";
        header("Location: auteur.php");
}
    
// READ auteurs FROM DATA BASE 
//*************delete ****************************/

if (isset($_GET['danger'])) {
    $id = $_GET['danger'];
    try{
    $sql=("DELETE FROM `auteur` WHERE idAuteur=$id");
    $conn->exec($sql);
        
    echo "deleted";
    
    }catch(PDOException $e){
        echo $e;
    } 
     header('refresh:1 url=auteur.php');
}
//**********************update*********************/



if(isset($_POST['update'])) {
    // update auteur image 
        $myFile = $_FILES['aut-imag'];
        $myFileName = $_FILES['aut-imag']['name'];
        $myFileTmpName = $_FILES['aut-imag']['tmp_name'];
        $myFileSize = $_FILES['aut-imag']['size'];
        $myFileError = $_FILES['aut-imag']['error'];
        $myFileType = $_FILES['aut-imag']['type'];
        global $myFileNewName;
        global $myFileDestination;
        $fileExt = explode('.', $myFileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt, $allowedExt)) {
            if($myFileError === 0) {
                if($myFileSize < 5000000) {
                    $myFileNewName = "ImgAut_" . uniqid('', true) . "." . $fileActualExt;
                    $myFileDestination = 'imgs/Aut/' . $myFileNewName;
                    move_uploaded_file($myFileTmpName, $myFileDestination);
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "there was an error uploading your file";
            }
        } else {
            echo "this file type is not allowed !";
        }
        
        
        
        $auteurName = test_input($_POST['aut-name']);
        $auteurEmail = test_input($_POST['aut-email']);
        $oldAvatar = test_input($_POST['old-avatar']);
        $id= test_input ($_POST ['id-auteur']);
        if ($myFileError){
            $auteurImage=$oldAvatar;
        }else{
            $auteurImage = $myFileNewName;
        }
        $insertAuteurQuery = "UPDATE auteur SET fullName=?, email=?, avatar=?  WHERE idAuteur =?";
        $prp = $conn-> prepare($insertAuteurQuery);
        $prp->execute([$auteurName,$auteurEmail,$auteurImage,$id]);
        echo "New record created successfully";
        header("Location: auteur.php");
}
// .............................................
// if (isset($_GET['edit'])){
//     $id= $_GET['edit'];
//     try{
//         $sql=$conn->prepare("SELECT  * FROM `auteur` WHERE idAuteur= $id");
        
//         $sql->execute();
//         $tab=$sql->fetchALL();
//         echo "element modifier";
//         print_r($tab);
//     }catch(PDOException $e){
//         echo $e;
//     }
   
// }
?>
