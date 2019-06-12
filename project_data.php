<?php
include "database_field.php";
include "project.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["operation"] == "delete") {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("DELETE FROM project WHERE projectId = ? ");
        $projectId = $_POST["projectId"];
        $stmt->bind_param("i", $projectId);
        $stmt->execute();

        $stmt->close();
        $conn->close();
        echo "success";
    } else {
        $projectName = "";
        // 驗證使用者輸入資料
        if (empty($_POST["projectName"])) { } else {
            $projectName = test_input($_POST["projectName"]);
        }

        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, "utf8");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO project (ownerId, projectId, projectName, initiateDate) VALUES (?, ?, ?, ?)");
        $ownerId = 1;
        $projectId = 1;
        $stmt->bind_param("iiss", $ownerId, $projectId, $projectName, date("Y-m-d"));
        $stmt->execute();

        $stmt->close();
        $conn->close();

        header("Location: ./index.html");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT ownerId, projectId, projectName, initiateDate FROM project";
    $result = $conn->query($sql);

    $projectAry = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $project = new Project();
            $project->ownerId = $row["ownerId"];
            $project->projectId = $row["projectId"];
            $project->projectName = $row["projectName"];
            $project->numberOfFiles = 0;
            $project->initiateDate = $row["initiateDate"];
            array_push($projectAry, $project);
        }
    }

    $conn->close();
    echo json_encode($projectAry);
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
