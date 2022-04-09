<?php

//process_data.php

if(isset($_POST["query"]))
{

	$connect = new PDO("mysql:host=localhost; dbname=licenta", "root", "");

	$data = array();

	if($_POST["query"] != '')
	{

		$condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);

		$condition = trim($condition);

		$condition = str_replace(" ", "%", $condition);

		$sample_data = array(
			':course_name'			=>	'%' . $condition . '%',
           
		
		);

		$query = "
		SELECT course_name
		FROM courses
		WHERE course_name LIKE :course_name 
		";

		$statement = $connect->prepare($query);

		$statement->execute($sample_data);

		$result = $statement->fetchAll();

		$replace_array_1 = explode('%', $condition);

		foreach($replace_array_1 as $row_data)
		{
			$replace_array_2[] = '<span style="background-color:#'.rand(100000, 999999).'; color:#fff">'.$row_data.'</span>';
		}

		foreach($result as $row)
		{
			$data[] = array(
				'course_name'		=>	str_ireplace($replace_array_1, $replace_array_2, $row["course_name"])
                
			);
		}

	}
	else
	{

		$query = "
		SELECT course_name
		FROM courses
		";

		$result = $connect->query($query);

		foreach($result as $row)
		{
			$data[] = array(
				'course_name'			=>	$row['course_name'],
                
			);
		}

	}

	echo json_encode($data);

}

?>