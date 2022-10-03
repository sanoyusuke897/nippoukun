function showtime(){
    var today = new Date();
    $weekday = ['日','月','火','水','木','金','土'];
    month = today.getMonth() + 1 ;
    $('#datetime').html( "<h3>" + month + "月"+ today.getDate() + "日</br>（" + $weekday[today.getDay()] + "）</h3> " + "<p class='fw-bolder time_text'>" + today.getHours() + ":" + ('0'+today.getMinutes()).slice(-2) + ":" + ('0' +today.getSeconds()).slice(-2) + "</p>" );
    }
setInterval(showtime,1000);
