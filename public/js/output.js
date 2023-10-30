$(document).ready(function () {
    function subTotal() {
        var iprice = document.getElementsByClassName("iprice");
        var itotal = document.getElementsByClassName("itotal");
        var iquantity = document.getElementsByClassName("iquantity");
        var gtotal = document.getElementById("gtotal");
        var discount = document.getElementById("discount");
        var deposit = document.getElementById("deposit");
        var credit = document.getElementById("credit");
        var gt = 0;
        var depo = 0;
        var cred = 0;

        for (let i = 0; i < iprice.length; i++) {
            const numberOnly = (
                iprice[i].value * iquantity[i].value
            ).toString(); // Convert the result to a string

            const number = parseFloat(numberOnly.replace(/[^0-9]/g, ""));
            const formattedNumber = number.toLocaleString();
            itotal[i].value = formattedNumber;
            gt = gt + iprice[i].value * iquantity[i].value;
            gtotal.value = gt - discount.value;
        }

       
        discount.addEventListener("input", function () {
            gtotal.value = gt - discount.value;
            credit.value = gtotal.value - deposit.value;
        });

        deposit.addEventListener("input", function () {
            credit.value = gtotal.value - deposit.value;
        });
        credit.value = gtotal.value - deposit.value;
    }
    subTotal();
    document
        .getElementById("discount")
        .addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent the Enter key's default behavior
                // You can add additional logic here, like handling the form data
            }
        });
    document
        .getElementById("gtotal")
        .addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent the Enter key's default behavior
                // You can add additional logic here, like handling the form data
            }
        });
    document
        .getElementById("credit")
        .addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent the Enter key's default behavior
                // You can add additional logic here, like handling the form data
            }
        });
    document
        .getElementById("deposit")
        .addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent the Enter key's default behavior
                // You can add additional logic here, like handling the form data
            }
        });
    document
        .getElementById("itemQuantity")
        .addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent the Enter key's default behavior
                // You can add additional logic here, like handling the form data
            }
        });
    var date = Date.now();

    var currentdate = new Date();
    var datetime =
        currentdate.getDate() +
        "/" +
        (currentdate.getMonth() + 1) +
        "/" +
        currentdate.getFullYear();
    $("#year").text(datetime);

    // Code for extract Weekday
    function myFunction() {
        var d = new Date();
        var weekday = new Array(7);
        weekday[0] = "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";

        var day = weekday[d.getDay()];
        return day;
    }
    var day = myFunction();
    $("#day").text(day);
    
   

    $(".get-details").click(function () {
        var button = $(this);
        var selectElement = document.getElementById("productselect");
        var selectedValue = selectElement.value;
        var items = document.getElementById("itemQuantity");
        var itemQuantity = items.value;

        $.ajax({
            url: "/get-product-details/" + selectedValue,
            type: "GET",
            success: function (data) {
                if (data.error) {
                    namePlaceholder.text("Error: " + data.error);
                    pricePlaceholder.text("");
                } else {
                    var table =
                        '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">' +
                        '<td class="px-6 py-4">' +
                        '<input type="text" readonly id="productinput" class="outline-none border-gray-300 border-transparent rounded-md product_select" value="' +
                        data.product_name +
                        '">' +
                        "</td>" +
                        '<td class="px-6 py-3">' +
                        '<input  type="number" readonly  name="price[]" class="outline-none border-transparent rounded-lg iprice" value="' +
                        data.price +
                        '" />' +
                        "</td>" +
                        "<td>" +
                        '<input type="number" readonly name="quantities[]" class="outline-none border-transparent border-gray-300 rounded-lg iquantity" value="' +
                        itemQuantity +
                        '" />' +
                        "</td>" +
                        "<td>" +
                        '<input type="text" name="serial[]" class="outline-none w-full text-right float-right border-gray-300 rounded-lg" value=""' +
                        +'" />' +
                        "</td>" +
                        "<td>" +
                        '<input type="text" name="" readonly class="outline-none w-full text-right float-right border-transparent rounded-lg itotal" value="' +
                        +'" />' +
                        "</td>" +
                        '<td class="px-6 py-4">' +
                        '<input type="text" readonly name="productsid[]" hidden id="productinput" class="outline-none border-gray-300 border-transparent rounded-md product_select" value="' +
                        selectedValue +
                        '">' +
                        "</td>" +
                        "</tr>";

                    $("#new").append(table);
                    subTotal();
                }
            },

            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });
    document.getElementById("delBut").addEventListener("click", function () {
        removeLastRow();
        subTotal();
        function removeLastRow() {
            var table = document.getElementById("new");
            var rowCount = table.rows.length;
            console.log(rowCount);
            if (rowCount > 0) {
                table.deleteRow(rowCount - 1);
            }
        }
    });
});
