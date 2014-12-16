<?php
use \pages\page as page;
   require_once'autoloader.php';
   
// question4
      class question4 extends page {
  
	function get(){
		$host = "sql2.njit.edu";
		$dbname = "ko45";
		$user ="ko45";
		$pass = "obscene78";
		try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
		$STH = $DBH->query("SELECT DISTINCT universities.Name, finances.N2011, enrollment.E2011, round(finances.N2011/enrollment.E2011,0) AS AssetPerS 
		FROM universities INNER JOIN finances ON finances.UID = universities.UID INNER JOIN enrollment ON universities.UID = enrollment.UID ORDER BY AssetPerS DESC");
		
		$this->content .= "<h1>a web page that lists the colleges with the largest amount of net assets per student</h1><br>"; 
		
		
		$this->content .= "<table align='center'>";
		$this->content .= "
			<tr>
				<th>Institution/College Name</th>
				<th>Total net assets per student</th>
			</tr>
		";
		
		while($rows = $STH->fetch()){
			$this->content .= "<tr>";
			$this->content .= "<td>" . $rows['Name'] . "</td>";
			$this->content .= "<td>" . $rows['AssetPerS'] . "</td>";
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