function las_coin() {
    $.ajax({
        type: 'GET',
        url: 'https://oa1sms.iwinv.net/phone_status_table_upload/las_tool_user/las_tool_user_proc.php',
        crossDomain: true,
        dataType: 'JSON',
        cache: false,
        data: {
            name: $('#name').val()
        },
        contentType: 'application/json; charset=utf-8',
        success: function(datas) {
            let rs = 0;
            let text = "";
            for (let i = 0; i < datas.length; i++) {
                if(datas[i].service == 'livescore'){
                rs = rs + parseInt(datas[i].coin);
                }
            }
            text += '<span> 고객 코인 잔여 : '+ rs +'</span>';
            $('#lasCoin').html(text);
        },
        error: function(xhr, status, error) {
            console.error("Error: ", status, error);
        }
    });

setTimeout('location.reload()',600000); 


}

