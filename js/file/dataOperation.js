// 查看訂單
function viewOrder(e) {
    e.preventDefault();
    $("#view_window").data("kendoWindow").center().open();
}

// 刪除檔案
function deleteFile(e) {
    e.preventDefault();
    var check = confirm("確定刪除檔案?");
    if (check) {
        var tr = $(e.target).closest("tr");
        var data = this.dataItem(tr);
        $.ajax({
            url: "file_data.php",
            data: { projectId: data.projectId, filePath: data.filePath, operation: "delete" },
            type: "POST",
            dataType: "text",
            success: function (result) {
                if (result == "delete success") {
                    $("#errorMsg").text("刪除成功").prop("class", "success");
                    $("#file_grid").data("kendoGrid").dataSource.read();
                } else {
                    $("#errorMsg").text(result).prop("class", "error");
                }
            },
            error: function () {
                $("#errorMsg").text("伺服器發生錯誤").prop("class", "error");
            }
        });
        /*var projectDataSource = $("#project_grid").data("kendoGrid").dataSource;
        projectDataSource.remove(data);*/
    }
}

// 根據檔名搜尋檔案
function searchFile() {
    var fileDataSource = $("#file_grid").data("kendoGrid").dataSource;
    var value = this.value;
    if (value == "") {
        fileDataSource.filter({});
    }
    fileDataSource.filter(
        { field: "fileName", operator: "contains", value: value }
    );
}