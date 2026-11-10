<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


#GET code - to return info on searched country
$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

#cities lookup
if ($lookup === 'cities') {
	$sql = "SELECT cities.name, cities.district, cities.population
	FROM cities
	JOIN countries
	ON cities.country_code = countries.code
	WHERE countries.name LIKE :country";

	$stmt = $conn->prepare($sql);
	$stmt->execute(['country' => '%' . $country . '%']);
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	echo "<table>";
	echo "<tr>";
	echo "<th>Name of Country</th>";
	echo "<th>District</th>";
	echo "<th> Population</th>";
	echo "</tr>";

	foreach ($results as $row) {
		echo "<tr>";
		echo "<td>" . htmlspecialchars($row['name']) . "</td>";
		echo "<td>" . htmlspecialchars($row['district']) . "</td>";
		echo "<td>" . htmlspecialchars($row['population'] ?? '') . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}

// country lookup
else {
	$sql = "SELECT * FROM countries WHERE name LIKE :country";
	$stmt = $conn->prepare($sql);
	$stmt->execute(['country' => '%' .$country . '%']);

	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	echo "<table>";
	echo "<tr>";
	echo "<th>Name of Country</th>";
	echo "<th>Continet</th>";
	echo "<th> Year of Independence</th>";
	echo "<th> Head of State</th>";
	echo "</tr>";
	foreach ($results as $row) {
		echo "<tr>";
		echo "<td>" . htmlspecialchars($row['name']) . "</td>";
		echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
		echo "<td>" . htmlspecialchars($row['independence_year'] ?? '') . "</td>";
		echo "<td>" . htmlspecialchars($row['head_of_state']?? '') . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>