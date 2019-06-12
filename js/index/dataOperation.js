// 查看檔案
function viewFiles(e) {
    e.preventDefault();
    var tr = $(e.target).closest("tr");
    var data = this.dataItem(tr);
    $(location).prop("href","file.html");
}

// 刪除專案
function deleteProject(e) {
    e.preventDefault();
    var check = confirm("確定刪除專案?");
    if (check) {
        var tr = $(e.target).closest("tr");
        var data = this.dataItem(tr);
        $.ajax({
            url: "project_data.php",
            data: { projectId: data.projectId, operation: "delete" },
            type: "POST",
            dataType: "text",
            success: function (result) {
                if (result == "success") {
                    alert("成功刪除");
                    $("#project_grid").data("kendoGrid").dataSource.read();
                }
            }
        });
        /*var projectDataSource = $("#project_grid").data("kendoGrid").dataSource;
        projectDataSource.remove(data);*/
    }

}

// 根據名稱搜尋專案
function searchProject() {
    var projectDataSource = $("#project_grid").data("kendoGrid").dataSource;
    var value = this.value;
    if (value == "") {
        projectDataSource.filter({});
    }
    projectDataSource.filter(
        { field: "projectName", operator: "contains", value: value }
    );
}