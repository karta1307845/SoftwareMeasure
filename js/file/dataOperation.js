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
                if (result == "success") {
                    alert("成功刪除");
                    $("#file_grid").data("kendoGrid").dataSource.read();
                }else{
                    alert("刪除失敗");
                    $("#file_grid").data("kendoGrid").dataSource.read();
                }
            }
        });
        /*var projectDataSource = $("#project_grid").data("kendoGrid").dataSource;
        projectDataSource.remove(data);*/
    }
}

// 根據檔案路徑搜尋檔案
function searchFile() {
    var fileDataSource = $("#file_grid").data("kendoGrid").dataSource;
    var value = this.value;
    if (value == "") {
        fileDataSource.filter({});
    }
    fileDataSource.filter(
        { field: "filePath", operator: "contains", value: value }
    );
}