document.getElementById("rst").addEventListener("click", function(event) {
    if (event.target && event.target.id === "copyTxtPN") {
        copyPN(event);
    } else if (event.target && event.target.id === "copyTxtCN") {
        copyCN(event);
    }
});

function copyPN(event) {
    var copyTxtPN = event.target;
    navigator.clipboard.writeText(copyTxtPN.innerText)
    .then(function() {
        var copyMessage = document.getElementById("copyMessage");
        copyMessage.style.display = "block";
        setTimeout(function() {
            copyMessage.style.display = "none";
        }, 400);
    })
    .catch(function(error) {
        console.error("복사 실패:", error);
    });
}

function copyCN(event) {
    var copyTxtCN = event.target;
    navigator.clipboard.writeText(copyTxtCN.innerText)
    .then(function() {
        var copyMessage = document.getElementById("copyMessage");
        copyMessage.style.display = "block";
        setTimeout(function() {
            copyMessage.style.display = "none";
        }, 400);
    })
    .catch(function(error) {
        console.error("복사 실패:", error);
    });
}

function get_number_load() {
    $.ajax({
        type: 'GET',
        url: 'https://oa1sms.iwinv.net/receive/receive_json.php',
        crossDomain: true,
        dataType: 'JSON',
        cache: false,
        data: {
            name: $('#name').val()
        },
        contentType: 'application/json; charset=utf-8',
        success: function(datas) {
            var text = "";
            
            $.each(datas, function(index, value) {
                text += "<tr>";
                text += "<td id=copyTxtPN>" + datas[index].RESULT1 + "</td>";
                text += "<td>" + datas[index].RESULT2 +"</td>";
                text += "<td id=copyTxtCN>" + datas[index].RESULT3 +"</td>";
                text += "<td>" + datas[index].RESULT4 + "</td>";
                text += "<td></td>";
                text += "</tr>";
            });
            $('#rst').html(text);
        }
    });
}

setInterval(function() {
    get_number_load(); 
}, 3000);
