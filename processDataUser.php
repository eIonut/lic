<?php

//process_data.php

if(isset($_POST["query"]))
{

	$connect = new PDO("mysql:host=localhost; dbname=lic", "root", "");

	$data = array();

	if($_POST["query"] != '')
	{

		$condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);

		$condition = trim($condition);

		$condition = str_replace(" ", "%", $condition);

		$sample_data = array(
			':name' => '%' . $condition . '%'
		);

		$query = "
		SELECT id, name, description, image
		FROM courses
		WHERE name LIKE :name
		";

		$statement = $connect->prepare($query);

		$statement->execute($sample_data);

		$result = $statement->fetchAll();

		$replace_array_1 = explode('%', $condition);

		foreach($replace_array_1 as $row_data)
		{
			$replace_array_2[] = ''.$row_data.'';
			
		}

		foreach($result as $row)
		{
			$data[] = array(
				'id' => str_ireplace($replace_array_1, $replace_array_2, $row["id"]),
				'name' => str_ireplace($replace_array_1, $replace_array_2, $row["name"]),
				'description' => str_ireplace($replace_array_1, $replace_array_2, $row["description"]),
				'image' => str_ireplace($replace_array_1, $replace_array_2, $row["image"]),
				
                
			);
		}

	}
	else
	{

		$query = "
		SELECT id, name, description, image
		FROM courses
		";

		$result = $connect->query($query);

		foreach($result as $row)
		{
			$data[] = array(
				'id' => $row['id'],
				'name' => $row['name'],
				'description' =>	$row['description'],
				'image' => $row['image']
                
			);
		}

	}
	
	echo json_encode($data);

}

?>