function deleteProduct(e) {
    var check = confirm("確定刪除此項商品?");
    if (check) {
        $(e.target).closest("tr").remove();
        if (checkOnlyOneProduct()) {
            $(".product_name").first().parent().next().next().empty();
        }
    }
}

function checkOnlyOneProduct() {
    var products = $(".product_name");
    if (products.length == 1) {
        return true;
    } else {
        return false;
    }
}

function addRow() {
    var newRow = "<tr><td><input type='text' class='product_name k-textbox' style='width:100%' autocomplete='off'></td><td><input name='quantity' style='width:100%'></td><td><button class='delete_product_btn' type='button' style='color:red'></button></td></tr>";
    $("#order_detail").append(newRow);
    $("[name='quantity']").last().kendoNumericTextBox({
        value: 1,
        min: 1,
        max: 100,
        step: 1,
        format: "n0"
    });

    var firstBtnTd = $(".product_name").first().parent().next().next();
    firstBtnTd.empty();
    firstBtnTd.append("<button class='delete_product_btn' type='button' style='color:red'></button>");

    var firstBtn = $(".delete_product_btn").first().kendoButton({
        icon: "close-circle"
    });
    firstBtn.click(deleteProduct);

    var lastBtn = $(".delete_product_btn").last().kendoButton({
        icon: "close-circle"

    });
    lastBtn.click(deleteProduct);
    $(".product_name").last().focus();
}

function windowRefresh() {
    var date = new Date();
    $("#buyer").val("").css("border-color", "");
    $("#phone").val("").css("border-color", "");
    $("#address").val("").css("border-color", "");
    $("#deliver_datepicker").data("kendoDatePicker").value(date);
    var table = $("#order_detail").find("tbody");
    table.empty();
    table.append("<tr><td><input type='text' class='product_name k-textbox' style='width:100%' autocomplete='off'></td><td><input name='quantity' style='width:100%'></td><td></td></tr>");
    $("[name='quantity']").kendoNumericTextBox({
        value: 1,
        min: 1,
        max: 100,
        step: 1,
        format: "n0"
    });
}

function viewWindowRefresh() {
    var table = $("#view_order_detail").find("tbody");
    table.empty();
}