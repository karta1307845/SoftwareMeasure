$(function () {
    $("#files").kendoUpload({
        async: {
            autoUpload: false,
            saveUrl: "./file_data.php"
        },
        localization: {
            select: "選擇檔案",
            clearSelectedFiles: "清除",
            uploadSelectedFiles: "上傳檔案",
            headerStatusUploaded: "完成",
            headerStatusUploading: "正在上傳",
            invalidFileExtension: "不允許的檔案格式"
        },
        validation: {
            allowedExtensions: [".jpg"],
            maxFileSize: 900000
        },
        multiple: false,
        success: function (e) {
            $("#errorMsg").text("上傳成功").prop("class", "success");
            $("#file_grid").data("kendoGrid").dataSource.read();
        },
        error: function (e) {
            var request = e.XMLHttpRequest;
            $("#errorMsg").text(request.responseText).prop("class", "error");
        }
    });

    // kendoWindow
    $("#view_window").kendoWindow({
        width: "450px",
        title: "分析結果",
        visible: false,
        actions: ["Close"],
        draggable: false,
        resizable: false,
        close: viewWindowRefresh
    }).data("kendoWindow")

    // kendoGrid
    $("#file_grid").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: "./file_data.php",
                    dataType: "json"
                }
            },
            schema: {
                model: {
                    fields: {
                        filePath: { type: "string" },
                        uploadDate: { type: "date" }
                    }
                }
            },
            pageSize: 20,
        },
        toolbar: kendo.template("<div class='grid-toolbar'><input id='file-grid-search' placeholder='搜尋檔名......' type='text'></input></div>"),
        height: 550,
        sortable: true,
        pageable: {
            input: true,
            numeric: false
        },
        columns: [
            { field: "filePath", title: "檔案名稱", width: "35%" },
            { field: "uploadDate", title: "上傳日期", width: "15%", format: "{0:yyyy-MM-dd}" },
            { command: { text: "分析", click: viewOrder }, title: " ", width: "95px" },
            { command: { text: "刪除", click: deleteFile }, title: " ", width: "95px" }
        ]

    });

    // 查看完訂單，關閉視窗
    $("#confirm_btn").click(function () {
        $("#view_window").data("kendoWindow").close();
    });

    // 搜尋檔案
    $("#file-grid-search").on("keyup", searchFile);
})