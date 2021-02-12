$(document).ready(function () {
    fetchCustomer();    
});
function fetchCustomer() {
    $.get("fetchCustomer.php",
        function (data) {
            $("#customers").html(data);   
        }
    );
}
function openTransfer(t) {
    let id = $(t).data("cid");
    $("#transferModel").on("show.bs.modal", function () {
           $.get("transferForm.php",{"id": id},
               function (data) {
                   $("#transferDetail").html(data);
               }
           );
    });
}
function transferMoney() {
    $("#transferForm").submit(function (e) { 
        e.preventDefault();
        let sender = $("#from").data("cid")
        let receiver = $("#to").val();
        let amount = $("#amount").val();
        let Formdata = {
            "sender":sender,
            "receiver":receiver,
            "amount":amount
        }
        $.ajax({
            type: "POST",
            url: "transferForm.php",
            cache:false,
            data: Formdata,
            success: function (response) {
                $("#transferDetail").html(response);
                fetchCustomer();
            }
        });
    });
}

function openTransaction(t) {
    let id = $(t).data("cid");
    window.location.href = "transaction.php?cid="+id;
}