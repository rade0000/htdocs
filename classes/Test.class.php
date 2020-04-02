<?php
Class Test{
	private static $db;
	public static function init(){
		self::$db = Connect::getInstance();
    }
	// 
public static function Student($id){
	$result = self::$db->query("SELECT * FROM students WHERE id = {$id}");
					while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
						//average
						$a = array($row['Grade_1'],$row['Grade_2'],$row['Grade_3'],$row['Grade_4']);

						
						// if dont have grades
									if ($row['Grade_1'] == 0){
										$row['Grade_1'] = 'No grade';
										unset($a['Grade_1']);
									}
									if ($row['Grade_2'] == 0){
										$row['Grade_2'] = 'No grade';
										unset($a['Grade_2']);
									}
									if ($row['Grade_3'] == 0){
										$row['Grade_3'] = 'No grade';
										unset($a['Grade_3']);
									}
									if ($row['Grade_4'] == 0){
										$row['Grade_4'] = 'No grade';
										unset($a['Grade_4']);
									}
						$average = array_sum($a) / count($a);
						$Board = $row['Board'];
						
						
						


							if (($row['Board'] == 'CSM') AND ($average >= 7)){
								
								$data = [ 'ID' => $row['id'], 'name' => $row['Name'], 'Grade 1' => $row['Grade_1'], 'Grade 2' => $row['Grade_2'], 'Grade 3' => $row['Grade_3'], 'Grade 4' => $row['Grade_4'], 'Average' => $average, 'Final Result' => 'Pass'];
								
								header('Content-type: application/json');
								echo json_encode($data);
								
							}else if (($row['Board'] == 'CSMB') AND (max($a) > 8) AND (count($a) > 2) ){
								
								
								$myXMLData =
								"<?xml version='1.0' encoding='UTF-8'?>
								<note>
								<ID>".$row['id']."</ID>
								<name>".$row['Name']."</name>
								<Grade1>".$row['Grade_1']."</Grade1>
								<Grade2>".$row['Grade_2']."</Grade2>
								<Grade3>".$row['Grade_3']."</Grade3>
								<Grade4>".$row['Grade_4']."</Grade4>
								<Biggest_Grade>".max($a)."</Biggest_Grade>
								<Average>".$average."</Average>
								<Final_Result>Pass</Final_Result>
								</note>";

								$xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");
								print_r($xml);
								
							}else{
										if ($row['Board'] == 'CSM'){
											
										$data = [ 'ID' => $row['id'], 'name' => $row['Name'], 'Grade 1' => $row['Grade_1'], 'Grade 2' => $row['Grade_2'], 'Grade 3' => $row['Grade_3'], 'Grade 4' => $row['Grade_4'], 'Average' => $average, 'Final Result' => 'Fail'];
										
										header('Content-type: application/json');
										echo json_encode($data);
										
										}else{
											$myXMLData =
											"<?xml version='1.0' encoding='UTF-8'?>
											<note>
											<ID>".$row['id']."</ID>
											<name>".$row['Name']."</name>
											<Grade_1>".$row['Grade_1']."</Grade_1>
											<Grade_2>".$row['Grade_2']."</Grade_2>
											<Grade_3>".$row['Grade_3']."</Grade_3>
											<Grade_4>".$row['Grade_4']."</Grade_4>
											<Biggest_Grade>".max($a)."</Biggest_Grade>
											<Average>".$average."</Average>
											<Final_Result>Fail</Final_Result>
											</note>";

											$xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");
											print_r($xml);
											
										}
							}



								
							

				}

}

public static function Students(){
	$result = self::$db->query("SELECT * FROM students");
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo "<ul>
			  <li><a href='/student/".$row['id']."' target='_blank'>".$row['Name']."</a> </li>
			  
			</ul>";

	 }
}

}
Test::init();








