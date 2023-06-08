<?php

    $method = array_keys($_POST);
    $id = $_POST[$method[0]];

    function deleteBook(){
        include 'php/conn.php';

        header("Location: .admin-dashboard.php");

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

        include 'php/conn.php';

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
        include 'php/conn.php';

        $id = $_POST['edit'];
        $sql = "SELECT * FROM books WHERE id = $id";
        $result = $conn->query($sql);

        if($row = $result->fetch_assoc()){
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
        }

        $conn->close();
    }

    function rejectRequest(){
        include 'php/conn.php';

        $id = $_POST['reject'];
        $sql = "UPDATE books_to_confirm SET status = 0 WHERE book_id = $id";
        $result = $conn->query($sql);

        if($result === true){
            echo "Success";
        }

        $conn->close();

        header("Location: ./admin-dashboard.php");
    }

    function acceptRequest(){
        include 'php/conn.php';

        $id = $_POST['accept'];
        $sql = "UPDATE books_to_confirm SET status = 1 WHERE $id = book_id";
        $result = $conn->query($sql);

        if($result === true){
            echo "Success";
        }

        $conn->close();

        header("Location: ./admin-dashboard.php");

    }
    
    if ($method[0] == 'delete'){
        deleteBook();
    }elseif($method[0] == 'edit'){
        getBookInfo();
    }elseif($method[0] == 'reject'){
        rejectRequest();
    }elseif($method[0] == 'accept'){
        acceptRequest();
    }
?>