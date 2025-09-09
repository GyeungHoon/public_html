function fun_load() {
    $.ajax({
        type: 'GET',
        url: 'https://oa1sms.iwinv.net/search/search_msg.php', 
        crossDomain: true,
        dataType: 'JSON',
        cache: false,
        data: {
            name: $('#name').val()
        },
        contentType: 'application/json; charset=utf-8',
        success: function(datas) {
            var text = "";
            let Hyphen = "-";
            let respTime = "";
            let reqPhoneNum = "";
            let respPhoneNum = "";
            $.each(datas, function(index, value) {
                respTime = datas[index].RESULT1.slice(5, 19);
                if (datas[index].RESULT2.length == 11) {
                    reqPhoneNum = datas[index].RESULT2.slice(0, 3) + Hyphen + datas[index].RESULT3.slice(3, 7) + Hyphen + datas[index].RESULT3.slice(7, 11);
                } else if (datas[index].RESULT2.length == 10) {
                    reqPhoneNum = datas[index].RESULT2.slice(0, 2) + Hyphen + datas[index].RESULT3.slice(2, 6) + Hyphen + datas[index].RESULT3.slice(6, 10);
                } else {
                    reqPhoneNum = datas[index].RESULT2;
                }
                respPhoneNum = datas[index].RESULT3.slice(0, 3) + Hyphen + "****" + Hyphen + datas[index].RESULT3.slice(7, 11);
                text += "<tr>";
                text += "<td>" + respTime + "</td>";
                text += "<td>" + reqPhoneNum + "</td>";
                text += "<td>" + respPhoneNum + "</td>";
                text += "<td>" + datas[index].RESULT4 + "</td>";
                text += "<td>" + datas[index].RESULT5 + "</td>";
                text += "</tr>";
            });
            $('#rst').html(text);
        },
        error: function(xhr, status, error) {
            console.error("Error: ", status, error); 
        }
    });
}
setInterval(function() {
    fun_load(); 
}, 3000);
