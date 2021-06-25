<!DOCTYPE html>
<html lang="en">
<head>
    <?php
include 'DBController.php';
$db_handle = new DBController();
?>
<meta charset="UTF-8">
<title>PHP Live MySQL Database Search</title>
<style>
    body{
        font-family: Arail, sans-serif;
        background-color : #E0f2ff;
    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
        text-align:center;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
    h1{
        font-size:55px;
    }
    .center {
  margin: auto;
 
}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
</head>
<body style="  background-color : #E0f2ff;">
    <header><h6 style=" font-size:30px;">Stock</h6></header>

 

<div class="container">
  <div class="row">
    <div class="col-sm-12">
        <div class="text-center">
            <h1 style=" font-size:55px;">The easiest way to buy<br> and sell Stocks.</h1>
            <p style=" font-size:24px;">Stock analysis and Screening tool<br> for investors in india</p>

            <form method="POST" name="search" action="index.php">
                <div class="search-box">
                    <div class="row">
                    <div class="col-sm-10">
                        <input type="text" id="Place" name="country[]" autocomplete="off" placeholder="Search country..." />
                     <div class="result"></div></div>
                     <div class="col-sm-2">
                            <button id="Filter">Search</button>
                        </div></div><br><br>

                    </div>
                </div>
            </form>
             <!-- Table -->
    <?php
                if (! empty($_POST['country'])) {
                    ?>

<div class="container">
  <div class="row">
      <div class="center" style="padding-top:20px;   background-color : #fff;">
          <h6>Tech Mahindra Ltd.</h6>
          <table cellpadding="10" cellspacing="1">


<tbody>
<?php
$query = "SELECT * from stock";
$i = 0;
$selectedOptionCount = count($_POST['country']);
$selectedOption = "";
while ($i < $selectedOptionCount) {
    $selectedOption = $selectedOption . "'" . $_POST['country'][$i] . "'";
    if ($i < $selectedOptionCount - 1) {
        $selectedOption = $selectedOption . ", ";
    }
    
    $i ++;
}
$query = $query . " WHERE Name in (" . $selectedOption . ")";

$result = $db_handle->runQuery($query);
}
if (! empty($result)) {
foreach ($result as $key => $value) {
    ?>
    <tr>
    <td>Market Cap </td>
    <td><div class="col" id="user_data_1" style="color:red">&#x20b9;<?php echo $result[$key]['Market_Cap']; ?></div></td>
    <td>Dividend Yield </td>
    <td><div class="col" id="user_data_1" style="color:red"><?php echo $result[$key]['DividendYield']; ?>%</div></td>
    <td>Debt to Equity </td>
    <td><div class="col" id="user_data_1" style="color:red"><?php echo $result[$key]['Equity']; ?>%</div></td>
  </tr>
  <tr>
    <td>Current Market Price</td>
    <td><div class="col" id="user_data_1" style="color:red">&#x20b9;<?php echo $result[$key]['Market_Price']; ?></div></td>
    <td>ROCE % </td>
    <td><div class="col" id="user_data_1" style="color:red"><?php echo $result[$key]['ROCE']; ?>%</div></td>
    <td>EPS </td>
    <td><div class="col" id="user_data_1" style="color:red">&#x20b9;<?php echo $result[$key]['EPS']; ?></div></td>
  </tr>
  <tr>
    <td>Stock P/E</td>
    <td><div class="col" id="user_data_1" style="color:red"><?php echo $result[$key]['P_E']; ?>%</div></td>
    <td>ROE Previous Annum</td>
    <td><div class="col" id="user_data_1" style="color:red"><?php echo $result[$key]['ROE']; ?>%</div></td>
    <td>Reserves </td>
    <td><div class="col" id="user_data_1" style="color:red">&#x20b9;<?php echo $result[$key]['Reserves']; ?></div></td>
  </tr>
  <tr>
    <td>Debt</td>
    <td><div class="col" id="user_data_1" style="color:red">&#x20b9;<?php echo $result[$key]['Debt']; ?></div></td>
   
  </tr>

<?php
}
?>

</tbody>
</table>
<?php
}
?>  
       </div>
    
  </div>
</div>
                
                <!-- end table -->
        </div>
        
    </div>
   
  </div>
</div>


   
</body>
</html>