<?php
session_start();
// Creer la connection
$con = new mysqli("localhost","root","","budget_base");

// Checker la connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
$totalrevenu = 0;
$update = false;
$id=0;

// c'est variables nous aident pour l'update  
$name = '';
$montant = '';
$date ='';

    if(isset($_POST['save'])){
       
        $income = $_POST['income'];
        $amount = $_POST['amount'];
        $date_revenu = $_POST['date_revenu'];
        
        $query = mysqli_query($con, "INSERT INTO income (name, amount, date_revenu) VALUE ('$income', '$amount','$date_revenu')"); 
        
        $_SESSION['message'] = "succès de l'Ajout!";
        $_SESSION['msg_type'] = "primary";

        header("location: revenu.php?result=true");
        

    }

    //calcule du revenu total
    $result = mysqli_query($con, "SELECT * FROM income");
    while($row = $result->fetch_assoc()){
        $totalrevenu = $totalrevenu + $row['amount'];
    }

    //supprimer la data

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $query = mysqli_query($con, "DELETE FROM income WHERE id=$id");
        $_SESSION['message'] = "succès de la Suppression!";
        $_SESSION['msg_type'] = "danger";

        header("location: revenu.php");

    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = mysqli_query($con, "SELECT * FROM income WHERE id=$id");

      
        if( mysqli_num_rows($result) == 1){
            $row = $result->fetch_assoc();
            $name= $row['name'];
            $montant = $row['amount'];
            $date = $row['date_revenu'];
        }
    
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $income = $_POST['income'];
        $amount = $_POST['amount'];
        $date_revenu = $_POST['date_revenu'];

        $query = mysqli_query($con, "UPDATE income SET name='$income', amount='$amount' , date_revenu='$date_revenu' WHERE id='$id'");
        $_SESSION['message'] = "succès de l'Update !";
        $_SESSION['msg_type'] = "success";
        header("location: revenu.php");
    }


?>

