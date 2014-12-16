<?php 

$csv = new CSVLoader();
$data = $csv->openFile('effy_year.csv');
$csv->writeToDatabase($data);

class csvloader{
	
	public function openFile($f){
		$firstLine = true;
		$fields;
		$data;
		if($handle = fopen($f,"r")){
			//reading the csv data.
			while($line = fgetcsv($handle)){
				if($firstLine == true){
					$firstLine = false;
					$fields = $line;
				}
				else{. 
				$data[] = array_combine($fields,$line);	
				}
			}
		fclose($handle);
		
		return $data;
		
		}
		else{
			echo "Failed to open the file " . $f;
		}
	}
	
		public function writeToDatabase($records){
		$table = "enrollment";
		$user = "ko45";
		$pass = "obscene78";
		try{
		$DBH = new PDO('mysql:host=sql2.njit.edu;dbname=ko45',$user,$pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		

		foreach($records as $record){
			$insert = null;
			foreach($record as $key => $value){
				$insert[] = $value;
			}
			
			print_r($insert);
			
			$STH = $DBH->prepare("insert into $table values(?,?,?)");
			$STH->execute($insert);	
		}
		
		
		$DBH = null;
		
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
	}
}


?>
