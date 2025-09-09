const downloadButton = document.getElementById('download');

function towerTableXlsxDown(rcc) {
    $.ajax({
        type: 'GET',
        url: 'https://oa1sms.iwinv.net/pst/table_' + rcc + '_proc.php',
        success: function (response) {
            if (response.length > 0) {
                datas = response;

                // 이벤트 리스너 중복 추가 방지
                downloadButton.addEventListener('click', function downloadEventHandler(event) {
                    event.preventDefault();

                    let xlsxData = [["PhName", "Phone Number", "Number Status", "Status Livescore", "Status Naver", "Status Ncsoft", "Status Instagram","Status Carrot","Status Line", "Status Telegram", "Status Google", "Status Gangnamunni", "Status Tiktok"]];

                    for (let i = 0; i < datas.length; i++) {
                        if (datas[i].number_status !== "" && datas[i].number_status !== null) {
                            if (datas[i].status_livescore == "sms_not_receive_1" || datas[i].status_livescore == "sms_not_receive_2" || datas[i].status_livescore == "sms_not_receive_3") {
                                datas[i].status_livescore = "안옴";
                            } else if (datas[i].status_livescore == "ban") {
                                datas[i].status_livescore = "짤";
                            } else if (datas[i].status_livescore == "error") {
                                datas[i].status_livescore = "";
                            } else if (datas[i].status_livescore == "waiting") {
                                datas[i].status_livescore = "waiting";
                            } else if (datas[i].status_livescore == "two_factor_auth") {
                                datas[i].status_livescore = "2차";
                            } else if (datas[i].status_livescore && datas[i].status_livescore.includes("success")) {
                                datas[i].status_livescore = "라스";
                            } else if (datas[i].status_livescore && datas[i].status_livescore.includes("standby")) {
                                datas[i].status_livescore = "";
                            } else { "설정이 필요합니다" }



                            // status_telegram
                            if (datas[i].status_telegram == "sms_not_receive_1" || datas[i].status_telegram == "sms_not_receive_2" || datas[i].status_telegram == "sms_not_receive_3") {
                                datas[i].status_telegram = "안옴";
                            } else if (datas[i].status_telegram == "ban") {
                                datas[i].status_telegram = "짤";
                            } else if (datas[i].status_telegram == "error") {
                                datas[i].status_telegram = "";
                            } else if (datas[i].status_telegram == "waiting") {
                                datas[i].status_telegram = "";
                            } else if (datas[i].status_telegram == "two_factor_auth") {
                                datas[i].status_telegram = "2차";
                            } else if (datas[i].status_telegram && datas[i].status_telegram.includes("success")) {
                                datas[i].status_telegram = "강재사용";
                            } else if (datas[i].status_telegram && datas[i].status_telegram.includes("standby")) {
                                datas[i].status_telegram = "";
                            } else { "설정이 필요합니다" }

                            // // status_carrot
                            // if (datas[i].status_carrot == "sms_not_receive_1" || datas[i].status_carrot == "sms_not_receive_2" || datas[i].status_carrot == "sms_not_receive_3") {
                            //     datas[i].status_carrot = "안옴";
                            // } else if (datas[i].status_carrot == "ban") {
                            //     datas[i].status_carrot = "짤";
                            // } else if (datas[i].status_carrot == "error") {
                            //     datas[i].status_carrot = "";
                            // } else if (datas[i].status_carrot == "waiting") {
                            //     datas[i].status_carrot = "waiting";
                            // } else if (datas[i].status_carrot == "two_factor_auth") {
                            //     datas[i].status_carrot = "2차";
                            // } else if (datas[i].status_carrot && datas[i].status_carrot.includes("success")) {
                            //     datas[i].status_carrot = "";
                            // } else if (datas[i].status_carrot && datas[i].status_carrot.includes("standby")) {
                            //     datas[i].status_carrot = "";
                            // } else { "설정이 필요합니다" }

                            // status_line
                            // if (datas[i].status_line == "sms_not_receive_1" || datas[i].status_line == "sms_not_receive_2" || datas[i].status_line == "sms_not_receive_3") {
                            //     datas[i].status_line = "안옴";
                            // } else if (datas[i].status_line == "ban") {
                            //     datas[i].status_line = "짤";
                            // } else if (datas[i].status_line == "error") {
                            //     datas[i].status_line = "";
                            // } else if (datas[i].status_line == "waiting") {
                            //     datas[i].status_line = "waiting";
                            // } else if (datas[i].status_line == "two_factor_auth") {
                            //     datas[i].status_line = "2차";
                            // } else if (datas[i].status_line && datas[i].status_line.includes("success")) {
                            //     datas[i].status_line = "라인";
                            // } else if (datas[i].status_line && datas[i].status_line.includes("standby")) {
                            //     datas[i].status_line = "";
                            // } else { "설정이 필요합니다" }

                            // status_naver
                            if (datas[i].status_naver == "sms_not_receive_1" || datas[i].status_naver == "sms_not_receive_2" || datas[i].status_naver == "sms_not_receive_3") {
                                datas[i].status_naver = "안옴";
                            } else if (datas[i].status_naver == "ban") {
                                datas[i].status_naver = "짤";
                            } else if (datas[i].status_naver == "error") {
                                datas[i].status_naver = "";
                            } else if (datas[i].status_naver == "waiting") {
                                datas[i].status_naver = "";
                            } else if (datas[i].status_naver == "two_factor_auth") {
                                datas[i].status_naver = "2차";
                            } else if (datas[i].status_naver && datas[i].status_naver.includes("success")) {
                                datas[i].status_naver = "네이버";
                            } else if (datas[i].status_naver && datas[i].status_naver.includes("standby")) {
                                datas[i].status_naver = "";
                            } else { "설정이 필요합니다" }

                            // status_google
                            if (datas[i].status_google == "sms_not_receive_1" || datas[i].status_google == "sms_not_receive_2" || datas[i].status_google == "sms_not_receive_3") {
                                datas[i].status_google = "안옴";
                            } else if (datas[i].status_google == "ban") {
                                datas[i].status_google = "짤";
                            } else if (datas[i].status_google == "error") {
                                datas[i].status_google = "";
                            } else if (datas[i].status_google == "waiting") {
                                datas[i].status_google = "";
                            } else if (datas[i].status_google == "two_factor_auth") {
                                datas[i].status_google = "2차";
                            } else if (datas[i].status_google && datas[i].status_google.includes("success")) {
                                datas[i].status_google = "구글";
                            } else if (datas[i].status_google && datas[i].status_google.includes("standby")) {
                                datas[i].status_google = "";
                            } else { "설정이 필요합니다" }

                            // status_gangnamunni
                            if (datas[i].status_gangnamunni == "sms_not_receive_1" || datas[i].status_gangnamunni == "sms_not_receive_2" || datas[i].status_gangnamunni == "sms_not_receive_3") {
                                datas[i].status_gangnamunni = "안옴";
                            } else if (datas[i].status_gangnamunni == "ban") {
                                datas[i].status_gangnamunni = "짤";
                            } else if (datas[i].status_gangnamunni == "error") {
                                datas[i].status_gangnamunni = "";
                            } else if (datas[i].status_gangnamunni == "waiting") {
                                datas[i].status_gangnamunni = "";
                            } else if (datas[i].status_gangnamunni == "two_factor_auth") {
                                datas[i].status_gangnamunni = "2차";
                            } else if (datas[i].status_gangnamunni && datas[i].status_gangnamunni.includes("success")) {
                                datas[i].status_gangnamunni = "강남언니";
                            } else if (datas[i].status_gangnamunni && datas[i].status_gangnamunni.includes("standby")) {
                                datas[i].status_gangnamunni = "";
                            } else { "설정이 필요합니다" }

                            // status_ncsoft
                            if (datas[i].status_ncsoft == "sms_not_receive_1" || datas[i].status_ncsoft == "sms_not_receive_2" || datas[i].status_ncsoft == "sms_not_receive_3") {
                                datas[i].status_ncsoft = "안옴";
                            } else if (datas[i].status_ncsoft == "ban") {
                                datas[i].status_ncsoft = "짤";
                            } else if (datas[i].status_ncsoft == "error") {
                                datas[i].status_ncsoft = "";
                            } else if (datas[i].status_ncsoft == "waiting") {
                                datas[i].status_ncsoft = "";
                            } else if (datas[i].status_ncsoft == "two_factor_auth") {
                                datas[i].status_ncsoft = "2차";
                            } else if (datas[i].status_ncsoft && datas[i].status_ncsoft.includes("success")) {
                                datas[i].status_ncsoft = "NCSOFT";
                            } else if (datas[i].status_ncsoft && datas[i].status_ncsoft.includes("standby")) {
                                datas[i].status_ncsoft = "";
                            } else { "설정이 필요합니다" }

                            // status_instagram
                            if (datas[i].status_instagram == "sms_not_receive_1" || datas[i].status_instagram == "sms_not_receive_2" || datas[i].status_instagram == "sms_not_receive_3") {
                                datas[i].status_instagram = "안옴";
                            } else if (datas[i].status_instagram == "ban") {
                                datas[i].status_instagram = "짤";
                            } else if (datas[i].status_instagram == "error") {
                                datas[i].status_instagram = "";
                            } else if (datas[i].status_instagram == "waiting") {
                                datas[i].status_instagram = "";
                            } else if (datas[i].status_instagram == "two_factor_auth") {
                                datas[i].status_instagram = "2차";
                            } else if (datas[i].status_instagram && datas[i].status_instagram.includes("success")) {
                                datas[i].status_instagram = "인스타그램";
                            } else if (datas[i].status_instagram && datas[i].status_instagram.includes("standby")) {
                                datas[i].status_instagram = "";
                            } else { "설정이 필요합니다" }

                             // status_tiktok
                             if (datas[i].status_tiktok == "sms_not_receive_1" || datas[i].status_tiktok == "sms_not_receive_2" || datas[i].status_tiktok == "sms_not_receive_3") {
                                datas[i].status_tiktok = "안옴";
                            } else if (datas[i].status_tiktok == "ban") {
                                datas[i].status_tiktok = "짤";
                            } else if (datas[i].status_tiktok == "error") {
                                datas[i].status_tiktok = "";
                            } else if (datas[i].status_tiktok == "waiting") {
                                datas[i].status_tiktok = "";
                            } else if (datas[i].status_tiktok == "two_factor_auth") {
                                datas[i].status_tiktok = "2차";
                            } else if (datas[i].status_tiktok && datas[i].status_tiktok.includes("success")) {
                                datas[i].status_tiktok = "틱톡";
                            } else if (datas[i].status_tiktok && datas[i].status_tiktok.includes("standby")) {
                                datas[i].status_tiktok = "";
                            } else { "설정이 필요합니다" }


                            xlsxData.push([
                                datas[i].phname,
                                datas[i].phone_number,
                                datas[i].number_status,
                                datas[i].status_livescore,
                                datas[i].status_naver,
                                datas[i].status_ncsoft,
                                datas[i].status_instagram,
                                datas[i].status_carrot,
                                datas[i].status_line,
                                datas[i].status_telegram,
                                datas[i].status_google,
                                datas[i].status_gangnamunni,
                                datas[i].status_tiktok
                            ]);
                        }
                    }

                    // 시트 생성
                    let wb = XLSX.utils.book_new();
                    let ws = XLSX.utils.aoa_to_sheet(xlsxData);

                    // 첫 번째 행 고정 (헤더 고정)
                    ws['!freeze'] = { xSplit: 0, ySplit: 1 };
 
                    // 컬럼 너비 설정
                    ws['!cols'] = [
                        { wch: 8 }, 
                        { wch: 13 },
                        { wch: 13 },
                        { wch: 14 },
                        { wch: 11 },
                        { wch: 12 },
                        { wch: 14 },
                        { wch: 12 },
                        { wch: 10 },
                        { wch: 14 },
                        { wch: 14 },
                        { wch: 17 },
                        { wch: 13 }
                    ];

                    
                    // 시트 추가
                    XLSX.utils.book_append_sheet(wb, ws, '시트1');

                    // 파일 다운로드
                    XLSX.writeFile(wb, '데이터.xlsx');

                    // 이벤트 리스너 제거 (한 번만 실행되게)
                    downloadButton.removeEventListener('click', downloadEventHandler);
                });
            } else {
                alert("현재 데이터가 없습니다");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error: ", status, error);
        }
    });
};

$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#top-btn').fadeIn();
        } else {
            $('#top-btn').fadeOut();
        }
    });

    $('#top-btn').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 300);
        return false;
    });
});
