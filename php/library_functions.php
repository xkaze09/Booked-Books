<?php

    $method = array_keys($_POST);
    $id = $_POST[$method[0]];

    function deleteBook(){
        include 'conn.php';

        $id = $_POST['delete'];
        $sql = "DELETE FROM books WHERE ID = $id";
        $result = $conn -> query($sql);

        if($result->num_rows > 0){
            
        }
    }
    
    if ($method[0] == 'delete'){
        deleteBook();
    }
?>