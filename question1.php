<?php
require_once'autoloader.php';
   	use \pages\page as page;
   
   	// question1
   class question1 extends page {
	function get(){
			$host = "sql2.njit.edu";
			$dbname = "ko45";
			$user ="ko45";
			$pass = "obscene78";
			try{
			$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$STH = $DBH->query("SELECT DISTINCT universities.Name, E2011 
			FROM enrollment INNER JOIN universities ON enrollment.UID = universities.UID ORDER BY enrollment.E2011 DESC ");
				
			$this->content .= "<h1>a web page that shows the colleges that have the highest enrollment.</h1><br>";
			
			$this->content .= "<table align='center'>";
			$this->content .= "
				<tr>
					<th>Institution/College Name</th>
					<th>Enrollment</th>
				</tr>
			";
			
			while($rows = $STH->fetch()){
				$this->content .= "<tr>";
				$this->content .= "<td>" . $rows['Name'] . "</td>";
				$this->content .= "<td>" . $rows['E2011'] . "</td>";
				$this->content .= "</tr>";
			}
			
			$this->content .= "</table>";
			
			$DBH = null;
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
		}
			
	}

?>