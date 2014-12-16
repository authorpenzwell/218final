<?php
use \pages\page as page;
   require_once'autoloader.php';
   
  // question5
	 class question5 extends page {
      
	function get(){
		$host = "sql2.njit.edu";
		$dbname = "ko45";
		$user ="ko45";
		$pass = "obscene78";
		try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$STH = $DBH->query("SELECT DISTINCT universities.Name,enrollment.E2010,enrollment.E2011,((enrollment.E2011-enrollment.E2010)/enrollment.E2010)*100 AS TotalIncrease FROM universities INNER JOIN enrollment ON enrollment.UID = universities.UID ORDER BY TotalIncrease DESC ");
		
		$this->content .= "<h1>a web page that shows the colleges with the largest percentage increase in enrollment between the years of 2011 and 2010</h1><br>"; 
		
		$this->content .= "<table align='center'>";
		$this->content .= "
			<tr>
				<th>Institution/College Name</th>
				<th>Increase in 2010</th>
				<th>Increase in 2011</th>
				<th>Total Percent Increase</th>
			</tr>
		";
		
		while($rows = $STH->fetch()){
			$this->content .= "<tr>";
			$this->content .= "<td>" . $rows['Name'] . "</td>";
			$this->content .= "<td>" . $rows['E2010'] . "</td>";
			$this->content .= "<td>" . $rows['E2011'] . "</td>";
			$this->content .= "<td>" . $rows['TotalIncrease'] . "</td>";
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