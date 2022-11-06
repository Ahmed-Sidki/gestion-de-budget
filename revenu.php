<?php require_once 'processRevenu.php'; ?>
<?php $con = new mysqli("localhost","root","","budget_base"); ?>
<?php  if(isset($_SESSION['message'])): ?>


<?php endif ?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Calculator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
                <h2 class="text-center">Ajouter Revenu</h2>
                <hr><br>
                <form action="processRevenu.php" method="POST">
                    <div class="form-group">
                        <label for="incomeTitle">Titre </label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="text" name="income" class="form-control" id="incomeTitle" placeholder="Entrer le titre du Revenu" required autocomplete="off"  value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="amount">Montant</label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Entrer le Montant" required  value="<?php echo $montant; ?>">
                    </div>
                    <label for="date_revenu">Date :</label>
                    <input type="date" name="date_revenu" value="<?php echo $date; ?>" required> 
                    <br><br>
                    <?php if($update == true): ?>
                    <button type="submit" name="update" class="btn btn-success btn-block">Update</button>
                    <?php else: ?>
                    <button type="submit" name="save" class="btn btn-primary btn-block">Save</button>
                    <?php endif; ?>
                </form>
            </div>
            <div class="col-md-8">
                <h2 class="text-center">Total du Revenu : <?php echo $totalrevenu;?> DH</h2>
                <hr>
                <br><br>
                <?php 

                     // affichage d'un message   
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
                <h2>Liste des Revenus</h2>

                <?php 
                    
                    $result = mysqli_query($con, "SELECT * FROM income");
                ?>
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <?php 
                            while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['amount']; ?> DH</td>
                                <td><?php echo $row['date_revenu']; ?></td>
                                <td>
                                    <a href="revenu.php?edit=<?php echo $row['id']; ?>" class="btn btn-success">edit</a>
                                    <a href="processRevenu.php?delete=<?php echo $row['id']; ?>"  class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                            

                        <?php endwhile ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>