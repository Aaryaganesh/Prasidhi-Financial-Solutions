<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<style>
		body {
			background-image: url("http://localhost:8080/image1.jpeg");
			background-size: cover;
			background-repeat: no-repeat;
		}
        .pay
      {
cursor: pointer;
color: white;
height: 50px;
width: 290px;
border: none;
margin: 20px 30px;
background-color: #19376D;
position: relative;
border-radius: 25px;
font-size: 18px;
text-align: center;
line-height: 50px;
left: 25px;
}
.pay:hover {
    background-color: #0B2447;
  }

       
	</style>
</head>
<body>
<?php

// Get the registration ID from the URL parameter
$reg_id = $_GET['id'];

// Retrieve the registration details from the database
$conn = new mysqli('localhost','root','','test');
if($conn->connect_error){
    die('connection failed :'.$conn->connect_error);
} else {
    $stmt = $conn->prepare("SELECT * FROM mainregistration WHERE id = ?");
    $stmt->bind_param("i", $reg_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $registration = $result->fetch_assoc();
    $stmt->close();
}

// Calculate the total amount due
// $service_prices = array(
//     "Service1" => 10,
//     "Service2" => 20,
//     "Service3" => 30
// );
$services= explode(",", $registration['Service']);
$temp = join("','", $services);
$total_amount = 0;
$sql = "SELECT s.name,c.price FROM services s 
join categories c on c.id=s.category_id
where s.name in ('".$temp."')";
$result = $conn->query($sql);
$string_builder ="";
if ($result != null) {

   
    while($row = $result->fetch_assoc()) {

        
        $total_amount = $total_amount+$row['price'];
        $string_builder  = $string_builder."<tr>";

        $string_builder= $string_builder. "<td>" . $row['name'] . "</td>";

        $string_builder= $string_builder. "<td>" . $row['price'] . "</td>";
        $string_builder=$string_builder. "</tr>";

    }

}
?>

<!-- HTML/CSS template for the invoice -->
<h1>Invoice</h1>
<p>Name: <?php echo $registration['Firstname'] . ' ' . $registration['Lastname']; ?></p>
<p>Email: <?php echo $registration['Email']; ?></p>
<style>
.background{
background-image: url("http://localhost:8080/image1.jpeg");}
table, th, td {
  border: 1px solid;
}
table {
  width: 60%;
}

th {
  height: 70px;
}
th {
  background-color:#19376D;
  color: white;
}

</style>

<table>
    <thead>
        <tr>
            <th>Service</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $string_builder; ?>
        
    </tbody>
    <tfoot>
        <tr>
            <td style="font-weight:bold">Total amount due:</td>
            <td><?php echo $total_amount; ?></td>
        </tr>
    </tfoot>
</table>
<button class="pay"  onclick="window.location.href='payment.html'">Proceed to Payment</button>

</body>
</html>
