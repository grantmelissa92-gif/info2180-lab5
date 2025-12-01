<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try{
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  
  $country = isset($_GET['country']) ? $_GET['country']: '';
  $lookup = isset($_GET['lookup']) ? $_GET['lookup']: '';

  if($lookup === 'cities'){
    $stmt = $conn->prepare(
      "SELECT cities.name AS city_name, cities.district, cities.population
      FROM cities
      JOIN countries ON cities.country_code = countries.code
      WHERE countries.name LIKE :country"
    );
    $stmt->bindValue(':country', '%'. $country. '%', PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(count($results) === 0){
      echo "<p>No City Found.</p>";
    }else{
      echo "<table>
            <thead>
              <tr>
                <th>Name</th>
                <th>District</th>
                <th>Population</th>
              </tr>
            </thead> 
            <tbody>";
          foreach ($results as $row){
            echo "<tr>
              <td>".$row['city_name']."</td>
              <td>".$row['district']."</td>
              <td>".$row['population']."</td>
              </tr>";
        }
        echo "</tbody>
        </table>";
    }
  }else{
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->bindValue(':country', '%'. $country. '%', PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($results) === 0){
      echo "<p>No Country Found.</p>";
    }else{
      echo "<table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
              </tr>
            </thead> 
            <tbody>";
          foreach ($results as $row){
            echo "<tr>
              <td>".$row['name']."</td>
              <td>".$row['continent']."</td>
              <td>".$row['independence_year']."</td>
              <td>".$row['head_of_state']."</td>
              </tr>";
        }
        echo "</tbody>
        </table>";
    }
  }
}catch(PDOException $e){
  echo "<p>Database Error:".$e->getMessage()."</p>";
}
?>


