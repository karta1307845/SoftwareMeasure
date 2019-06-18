<?php
include "database_field.php";
include "project.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["operation"]) && $_POST["operation"] == "delete") {  // 刪除專案
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("DELETE FROM project WHERE projectId = ? AND ownerId = ?");
        $projectId = $_POST["projectId"];
        $ownerId = $_SESSION["id"];
        $stmt->bind_param("ii", $projectId, $ownerId);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        if (!rmdir("upload/" . $ownerId . "/" . $projectId)) {
            echo ("無法移除專案資料夾");
            exit;
        }
        echo "delete success";
        exit;
    } else if (isset($_POST["operation"]) && $_POST["operation"] == "add") {  // 新增專案
        $projectName = "";
        // 驗證使用者輸入資料
        if (empty($_POST["projectName"]) && $_POST["projectName"] != "0") {
            echo "專案名稱不能為空";
            exit;
        } else {
            $projectName = test_input($_POST["projectName"]);
        }

        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, "utf8");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO project (ownerId, projectName, initiateDate) VALUES (?, ?, ?)");
        $ownerId = $_SESSION["id"];
        date_default_timezone_set("Asia/Taipei");
        $initiateTime = date("Y-m-d H:i:s");
        $stmt->bind_param("iss", $ownerId, $projectName, $initiateTime);
        $stmt->execute();

        if (!mkdir("upload/" . $ownerId . "/" . $stmt->insert_id)) {
            echo "建立專案資料夾失敗";
            exit;
        }


        $stmt->close();
        $conn->close();
        echo "add success";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {  // 取得專案資料
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT project.projectId, projectName, initiateDate, COUNT(filePath) AS fileNumber
    FROM project LEFT JOIN file 
    ON project.ownerId = file.ownerId
    AND project.projectId = file.projectId 
    WHERE project.ownerId = " . $_SESSION["id"] . " GROUP BY projectId";

    $result = $conn->query($sql);

    $projectAry = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $project = new Project();
            $project->ownerId = $_SESSION["id"];
            $project->projectId = $row["projectId"];
            $project->projectName = $row["projectName"];
            $project->numberOfFiles = $row["fileNumber"];
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
