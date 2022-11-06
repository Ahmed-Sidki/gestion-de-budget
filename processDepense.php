<?php
session_start();
// Creer la connection
$con = new mysqli("localhost","root","","budget_base");

// Checker la connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$totaldepense = 0;
$update = false;
$id=0;
$name = '';
$amount = '';
$categorie_modifie = '';
$date ='';

    if(isset($_POST['save'])){
       
        $budget = $_POST['budget'];
        $amount = $_POST['amount'];
        $categorie = $_POST['categorie'];
        $date_budget = $_POST['date_budget'];


        $query = mysqli_query($con, "INSERT INTO budget (categorie, name, amount, date_budget) VALUE ('$categorie','$budget', '$amount', '$date_budget')"); 
        
        $_SESSION['message'] = "succès de l'Ajout!";
        $_SESSION['msg_type'] = "primary";

        header("location: depense.php?result=true");
        

    }

    //calcule des depenses
    $result = mysqli_query($con, "SELECT * FROM budget");
    while($row = $result->fetch_assoc()){
        $totaldepense = $totaldepense + $row['amount'];
    }

    //supprimer la data

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $query = mysqli_query($con, "DELETE FROM budget WHERE id=$id");
        $_SESSION['message'] = "succès de la Suppression!";
        $_SESSION['msg_type'] = "danger";

        header("location: depense.php");

    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = mysqli_query($con, "SELECT * FROM budget WHERE id=$id");
        
      
        if( mysqli_num_rows($result) == 1){
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $amount = $row['amount'];
            $categorie_modifie = $row['categorie'];
            $date = $row['date_budget'];
        }
    
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $budget = $_POST['budget'];
        $amount = $_POST['amount'];
        $categorie = $_POST['categorie'];
        $date_budget = $_POST['date_budget'];
        
        $query = mysqli_query($con, "UPDATE budget SET categorie='$categorie', name='$budget', amount='$amount',date_budget='$date_budget' WHERE id='$id'");
        $_SESSION['message'] = "succès de l'Update !";
        $_SESSION['msg_type'] = "success";
        header("location: depense.php");
    }


?>

