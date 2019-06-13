<?php
include "database_field.php";
include "file.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["operation"]) && $_POST["operation"] == "delete") {
        $deleteFile = $_POST["filePath"];
        if (unlink($deleteFile)) {
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("DELETE FROM file WHERE projectId = ? ");
            $projectId = $_POST["projectId"];
            $stmt->bind_param("i", $projectId);
            $stmt->execute();

            $stmt->close();
            $conn->close();
            echo "success";
        } else {
            echo "delete failed";
        }
    } else {
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["files"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if ($_FILES["files"]["size"] > 500000) {
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg") {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "上傳失敗";
        } else {
            if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
                $conn = new mysqli($servername, $username, $password, $dbname);
                mysqli_set_charset($conn, "utf8");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $stmt = $conn->prepare("INSERT INTO file (ownerId, projectId, filePath, uploadDate) VALUES (?, ?, ?, ?)");
                $ownerId = 1;
                $projectId = 1;
                $uploadDate = date("Y-m-d");
                $stmt->bind_param("iiss", $ownerId, $projectId, $target_file, $uploadDate);
                $stmt->execute();

                $stmt->close();
                $conn->close();
            } else {
                echo "上傳時發生錯誤";
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, "utf8");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT ownerId, projectId, filePath, uploadDate FROM file";
    $result = $conn->query($sql);

    $fileAry = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $file = new File();
            $file->ownerId = $row["ownerId"];
            $file->projectId = $row["projectId"];
            $file->filePath = $row["filePath"];
            $file->uploadDate = $row["uploadDate"];
            array_push($fileAry, $file);
        }
    }

    $conn->close();
    echo json_encode($fileAry);
}
