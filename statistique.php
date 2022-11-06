<?php $con = new mysqli("localhost","root","","budget_base"); ?>
<?php 
      $totaldepense=0;
      $totalrevenu=0;
      $total_Nourriture = 0;
      $total_Facture = 0;
      $total_Voyage= 0;
      $total_Magasin = 0;
      $total_Autre = 0;
      $result = mysqli_query($con, "SELECT * FROM budget where categorie ='Nourriture'");
      while($row = $result->fetch_assoc()){
          $total_Nourriture = $total_Nourriture + $row['amount'];
      }
      $result = mysqli_query($con, "SELECT * FROM budget where categorie ='Facture'");
      while($row = $result->fetch_assoc()){
          $total_Facture = $total_Nourriture + $row['amount'];
      }
      $result = mysqli_query($con, "SELECT * FROM budget where categorie ='Voyage'");
      while($row = $result->fetch_assoc()){
          $total_Voyage = $total_Nourriture + $row['amount'];
      }
      $result = mysqli_query($con, "SELECT * FROM budget where categorie ='Magasin'");
      while($row = $result->fetch_assoc()){
          $total_Magasin = $total_Nourriture + $row['amount'];
      }
      $result = mysqli_query($con, "SELECT * FROM budget where categorie ='Autre'");
      while($row = $result->fetch_assoc()){
          $total_Autre = $total_Nourriture + $row['amount'];
      }
      $result = mysqli_query($con, "SELECT * FROM budget");
      while($row = $result->fetch_assoc()){
          $totaldepense = $totaldepense + $row['amount'];
      }
      $result = mysqli_query($con, "SELECT * FROM income");
      while($row = $result->fetch_assoc()){
          $totalrevenu = $totalrevenu + $row['amount'];
      }  
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Calculator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #chartdiv {
        width: 50%;
        height: 300px;
        }
        .charts{
            display:flex;
        }
        #chartdiv2 {
        width: 50%;
        height: 300px;
        }
    </style>
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
    <br><br><br><br><br>
    <div class="charts">
    <div id="chartdiv"></div>
    <div id="chartdiv2"></div>
    </div>

    
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script>
am5.ready(function() {

var root = am5.Root.new("chartdiv");

root.setThemes([
  am5themes_Animated.new(root)
]);

var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX",
  layout: root.verticalLayout
}));


var colors = chart.get("colors");

var data = [{
  categorie: "Nourriture",
  total: <?php echo "$total_Nourriture"?>,
  columnSettings: { fill: colors.next() }
}, {
  categorie: "Facture",
  total: <?php echo "$total_Facture"?>,
  columnSettings: { fill: colors.next() }
}, {
  categorie: "Voyage",
  total: <?php echo "$total_Voyage"?>,
  columnSettings: { fill: colors.next() }
}, {
  categorie: "Magasin",
  total: <?php echo "$total_Magasin"?>,
  columnSettings: { fill: colors.next() }
}, {
  categorie: "Autre",
  total: <?php echo "$total_Autre"?>,
  columnSettings: { fill: colors.next() }
}];

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "categorie",
  renderer: am5xy.AxisRendererX.new(root, {
    minGridDistance: 30
  }),
  bullet: function (root, axis, dataItem) {
    return am5xy.AxisBullet.new(root, {
      location: 0.5,
      sprite: am5.Picture.new(root, {
        width: 24,
        height: 24,
        centerY: am5.p50,
        centerX: am5.p50,
        src: dataItem.dataContext.icon
      })
    });
  }
}));

xAxis.get("renderer").labels.template.setAll({
  paddingTop: 20
});

xAxis.data.setAll(data);

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererY.new(root, {})
}));

var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "total",
  categoryXField: "categorie"
}));

series.columns.template.setAll({
  tooltipText: "{categoryX}: {valueY}",
  tooltipY: 0,
  strokeOpacity: 0,
  templateField: "columnSettings"
});

series.data.setAll(data);

series.appear();
chart.appear(1000, 100);

}); 

am5.ready(function() {

var root = am5.Root.new("chartdiv2");

root.setThemes([
  am5themes_Animated.new(root)
]);

var chart = root.container.children.push(
  am5percent.PieChart.new(root, {
    endAngle: 270
  })
);

var series = chart.series.push(
  am5percent.PieSeries.new(root, {
    valueField: "value",
    categoryField: "category",
    endAngle: 270
  })
);

series.states.create("hidden", {
  endAngle: -90
});

series.data.setAll([{
  category: "Revenu",
  value: <?php echo "$totalrevenu"?>
}, {
  category: "Dépenses",
  value: <?php echo "$totaldepense"?>
}]);

series.appear(1000, 100);

});
</script>
</body>
</html>
