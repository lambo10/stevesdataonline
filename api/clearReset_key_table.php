<?php

$sql = "DELETE FROM reset_key WHERE expirey_date < NOW()";

		if ($conn->query($sql) === TRUE) {
		}

?>