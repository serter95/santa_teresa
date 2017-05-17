<?php
	while ($result = $datos->fetch(\PDO::FETCH_ASSOC))
	{
		echo $result['id']." ".$result['nombre'];
    }
?>