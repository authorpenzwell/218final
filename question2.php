<?php

	use \pages\page as page;
   require_once'autoloader.php';
   
// question2
   class question2 extends page {
		function get(){
				$host = "sql2.njit.edu";
				$dbname = "ko45";
				$user ="ko45";
				$pass = "obscene78";
				try{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			$STH = $DBH->query("SELECT DISTINCT universities.Name, finances.L2011 
			FROM universities INNER JOIN finances ON finances.UID = universities.UID ORDER BY finances.L2011 DESC  ");
				
			$this->content .= "<h1>a web page that that lists the colleges with the largest amount of total liabilities</h1><br>";
		
				$this->content .= "<table align='center'>";
				$this->content .= "
					<tr>
						<th>Institution/College Name</th>
						<th>Total Liabilities</th>
					</tr>
				";
				
				while($rows = $STH->fetch()){
					$this->content .= "<tr>";
					$this->content .= "<td>" . $rows['Name'] . "</td>";
					$this->content .= "<td>" . $rows['L2011'] . "</td>";
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