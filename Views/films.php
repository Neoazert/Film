<?php
	$title = "Liste des films référencés";
	ob_start();
			
			echo '<h1> <strong> Liste des films </strong> </h1>';
			echo '<p>'.$count.' film(s) trouvé(s) dans la base de donnée. </p>';
			echo "
				<table>
			";
				echo " 
					<tr>
						<th> Titre </th> <th> Année </th> <th> Score </th> <th> Vote </th> <th>  </th>
					</tr>
				";
				foreach ($data as $i)
				{
					echo '<tr> <td>'.$i['Titre'].'</td>';
					echo '<td>'.$i['Année'].'</td>'; 
					echo '<td>'.$i['Score'].'</td>';
					echo '<td>'.$i['Vote'].'</td>'; 
					echo '<td> <a href="index.php?movieid='.$i['MovieID'].'"> Details </a></td> </tr>';
				}
			echo "
				</table>
			";
			
			$contenu = ob_get_clean();
			require("Views/layout.php");
			
		?>	