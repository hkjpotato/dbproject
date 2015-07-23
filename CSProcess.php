<?php 

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
	// ssh academic-mysql.cc.gatech.edu khuang66 
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "cs4400";
	$data= array();
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	
	$year = $_POST['year'];
	$mincompl = $_POST['mincompl'];
	$maxscore = $_POST['maxscore'];



	
$sql1 =
"SELECT r.name as name, CONCAT( r.street, ' ', r.city, ' ', r.state, ' ', r.zipcode ) AS address, CONCAT(o.firstname, o.lastname ) AS operator, r.email as email, ii.totalscore as score, COUNT( DISTINCT c.cdate) as numcompl
FROM restaurant AS r, operatorowner AS o, complaint AS c, inspection AS ii
WHERE YEAR( cdate ) ="
.$year
." AND r.rid = c.rid
AND o.email = r.email
AND ii.rid = r.rid
AND r.rid
IN (
SELECT rid
FROM complaint
GROUP BY rid
HAVING COUNT( * ) >= "
.$mincompl
.")
AND (
r.rid, ii.idate
)
IN (

SELECT i.rid, i.idate
FROM inspection AS i
NATURAL JOIN (

SELECT rid, MAX( idate ) idate
FROM inspection
GROUP BY rid
)imaxdate
WHERE i.totalscore <="
.$maxscore
.")
AND (
r.rid, ii.idate
)
IN (

SELECT c.rid, c.idate
FROM contains AS c
NATURAL JOIN (

SELECT rid, MAX( idate ) idate
FROM contains 
GROUP BY rid
)imaxdate
WHERE c.itemnum <9
AND c.score <9
)
GROUP BY r.name";

	$result1 = $conn->query($sql1);
	$count = 0;
	while ($rs = $result1->fetch_array(MYSQLI_ASSOC) ) {
	    //output data of each row
		$data[$count] = array();
		$data[$count]['name'] = $rs['name'];
		$data[$count]['operator'] = $rs['operator'];
		$data[$count]['address'] = $rs['address'];
		$data[$count]['email'] = $rs['email'];
		$data[$count]['numcompl'] = $rs['numcompl'];
		$data[$count]['score'] = $rs['score'];
		$data[$count]['complaints'] = array();
		$data[$count]['numcompl'] = 0;
	    $count++;

	} 


// the return data should be array of         {name: 'first', complaints:['1','2', '3'], address:'lalalala', email: '@@@', numcompl:'5', score: 5},
//$data[$count] = array();
//$data[$count]['name'] = $rs['name'];
//$data[$count]['address'] = $rs['address'];
//$data[$count]['email'] = $rs['email'];
//$data[$count]['numcompl'] = $rs['numcompl'];
//$data[$count]['score'] = $rs['score'];
//$data[$count]['complaints'] = array();

$sql2 = 
"SELECT r.name as name, c.description as content
FROM restaurant AS r, operatorowner AS o, complaint AS c, inspection AS ii
WHERE YEAR( cdate ) = "
.$year
." AND r.rid = c.rid
AND o.email = r.email
AND ii.rid = r.rid
AND r.rid
IN (
SELECT rid
FROM complaint
GROUP BY rid
HAVING COUNT( * ) >="
.$mincompl
.")
AND (
r.rid, ii.idate
)
IN (
SELECT i.rid, i.idate
FROM inspection AS i
NATURAL JOIN (
SELECT rid, MAX( idate ) idate
FROM inspection
GROUP BY rid
)imaxdate
WHERE i.totalscore <= "
.$maxscore
.")
AND (
r.rid, ii.idate
)
IN (
SELECT c.rid, c.idate
FROM `contains` AS c
NATURAL JOIN (
SELECT rid, MAX( idate ) idate
FROM `contains` 
GROUP BY rid
)imaxdate
WHERE c.itemnum <9
AND c.score <9
)
GROUP BY c.description
";

	$result2 = $conn->query($sql2);
	$count = 0;
	while ($rs = $result2->fetch_array(MYSQLI_ASSOC) ) {
		//for the second return
		$resname = $rs['name'];
		$content = $rs['content'];
		for ($i = 0; $i < sizeof($data); $i++) {
			if ($data[$i]['name'] == $resname) {
				array_push($data[$i]['complaints'], $content);
				$data[$i]['numcompl']++;
			}
		}

	} 





//$data[$count] = array();
//$data[$count]['name'] = $rs['name'];
//$data[$count]['content'] = $rs['content'];



//or?
//if 



//$data[$count]['email'] = $rs['email'];
//$data[$count]['numcompl'] = $rs['numcompl'];
//$data[$count]['score'] = $rs['score'];
//$data[$count]['complaints'] = array();








	// $sql = "SELECT r.cuisine AS cuisine, r.name AS name,CONCAT(r.street, ' ', r.city, ' ', r.state, ' ', r.zipcode) AS address, MAX(i.totalscore) as score FROM restaurant AS r,inspection AS i WHERE YEAR(idate) = "
	// .$year
	// ." and r.county = '"
	// .$county
	// ."' and i.rid = r.rid GROUP BY r.cuisine";

	// $result = $conn->query($sql);
	// $count = 0;
	// while ($rs = $result->fetch_array(MYSQLI_ASSOC) ) {
	//     //output data of each row
	//     $data[$count] = array();
	//     $data[$count]['county'] = $rs['county'];
	//     $data[$count]['cuisine'] = $rs['cuisine'];
	//     $data[$count]['inspected'] = $rs['inspected'];
	//     $data[$count]['failed'] = $rs['failed'];
	//     $count++;

	// } 

	$conn->close();

	echo json_encode($data);


?> 