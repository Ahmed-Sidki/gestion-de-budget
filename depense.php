<?php require_once 'processDepense.php'; ?>
<?php $con = new mysqli("localhost","root","","budget_base"); ?>
<?php  if(isset($_SESSION['message'])): ?>


<?php endif ?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Calculator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Budget Application</a>
    </div>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="revenu.php">Revenu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="depense.php">Dépenses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="statistique.php">Statistique</a>
        </li>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="text-center">Ajouter dépense</h2>
                <hr><br>
                <form action="processDepense.php" method="POST">
                    <label for="budgetTitle">Catégorie </label>
                    <br>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="categorie" required>
                    <?php if(isset($_GET['edit'])){
                        echo "<option value ='{$categorie_modifie}'>{$categorie_modifie}</option>";
                    }
                    else echo "<option value=''>--Choisir une option--</option>";
                    ?>
                    <option value="Nourriture">Nourriture</option>
                    <option value="Facture">Facture</option>
                    <option value="Voyage">Voyage</option>
                    <option value="Magasin">Magasin</option>
                    <option value="Autre">Autre</option>
                    </select>
                    <div class="form-group">
                        <label for="budgetTitle">Titre </label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="text" name="budget" class="form-control" id="budgetTitle" placeholder="Entrer le titre du Budget" required autocomplete="off"  value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="amount">Montant</label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Entrer le Montant" required  value="<?php echo $amount; ?>">
                    </div>
                    <label for="date_revenu">Date :</label>
                    <input type="date" name="date_budget" value="<?php echo $date; ?>" required> 
                    <br><br>
                    <?php if($update == true): ?>
                    <button type="submit" name="update" class="btn btn-success btn-block">Update</button>
                    <?php else: ?>
                    <button type="submit" name="save" class="btn btn-primary btn-block">Save</button>
                    <?php endif; ?>
                </form>
            </div>
            <div class="col-md-8">
                <h2 class="text-center">Total des dépenses : <?php echo $totaldepense;?> DH</h2>
                <hr>
                <br><br>

                <?php 
                    // affichage du message 
                    if(isset($_SESSION['message'])){
                        echo    "<div class='alert alert-{$_SESSION['msg_type']} alert-dismissible fade show ' role='alert'>
                                    <strong> {$_SESSION['message']} </strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                ";
                    }

                ?>
                <h2>Liste des Dépenses</h2>

                <?php 
                    
                    $result = mysqli_query($con, "SELECT * FROM budget");
                ?>
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Categorie</th>
                                <th>Nom</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <?php 
                            while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['categorie']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['amount']; ?> DH</td>
                                <td><?php echo $row['date_budget']; ?></td>
                                <td>
                                    <a href="depense.php?edit=<?php echo $row['id']; ?>" class="btn btn-success">edit</a>
                                    <a href="processDepense.php?delete=<?php echo $row['id']; ?>"  class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                            

                        <?php endwhile ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
</body>
</html>