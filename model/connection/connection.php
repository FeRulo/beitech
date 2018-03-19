<?php
function openConnection(){
	$conn = mysqli_connect('localhost', 'root', '', 'beitech');
    if (!$conn) {
        die('No se pudo conectar a MySQL: ' . mysqli_connect_error());
    }
    return $conn;
}

function closeConnection($conn){
    mysqli_close($conn);
}
?>	