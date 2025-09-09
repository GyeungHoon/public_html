function search(){
    let selectUser = document.getElementById("user");
    let selectUserIndex = document.getElementById("user").options.selectedIndex;
    let selectType = document.getElementById("type");
    let selectTypeIndex = document.getElementById("type").options.selectedIndex;

    if(!selectUserIndex){
        alert("고객을 선택해주세요");
    }else if(!selectTypeIndex){
        alert("문자종류를 선택해주세요");
    }else if(selectUserIndex && selectTypeIndex){
        location.href='/admin_hi/select_query_proc.php?val='+selectType.options[selectTypeIndex].value+'&idx='+selectUser.options[selectUserIndex].value;    
    }
}


