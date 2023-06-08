<?php

    $method = array_keys($_POST);
    $id = $_POST[$method[0]];

    function deleteBook(){
        include 'conn.php';

        $id = $_POST['delete'];
        $sql = "DELETE FROM books WHERE id = $id";
        $result = $conn -> query($sql);

        if($result === TRUE){
            echo "<script>alert(Entry deleted.);</script>";
        }else{
            echo "Error: ".$conn->error;
        }
        $conn->close();
    }

    function editBook($row){
        
        include 'conn.php';

        $book = array(
            "id" => $row["id"],
            "title" => $row["title"],
            "author" => $row["author"],
            "description" => $row["description"],
            "genre" => $row["genre"],
            "cover-image" => $row["cover_image"],
            "availability" => $row["availability"],
            "quantity" => $row["quantity"]
        );

        $conn->close();

        $bookJSON = json_encode($book);
        
        header("Content-Type: application/json");
        echo $bookJSON;
    }

    function getBookInfo(){
        include 'conn.php';

        $id = $_POST['edit'];
        $sql = "SELECT * FROM books WHERE id = $id";
        $result = $conn->query($sql);

        if($row = $result->fetch_assoc()){
            editBook($row);
        }

        $conn->close();
    }
    
    if ($method[0] == 'delete'){
        deleteBook();
    }elseif($method[0] == 'edit'){
        getBookInfo();
    }
?>