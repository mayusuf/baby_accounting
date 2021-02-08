var d = new Date();

var weekday = new Array(7);

weekday[0] = "Sun";
weekday[1] = "Mon";
weekday[2] = "Tue";
weekday[3] = "Wed";
weekday[4] = "Thu";
weekday[5] = "Fri";
weekday[6] = "Sat";

var monthname = new Array(12);

monthname[0] = "Jan";
monthname[1] = "Feb";
monthname[2] = "Mar";
monthname[3] = "Apr";
monthname[4] = "May";
monthname[5] = "Jun";
monthname[6] = "July";
monthname[7] = "Aug";
monthname[8] = "Sep";
monthname[9] = "Oct";
monthname[10] = "Nov";
monthname[11] = "Dec";


var date = d.getDate();
var day = d.getDay();
var mon = d.getMonth();

document.getElementById("date-box1").innerHTML = date + "  " + monthname[mon] + " "+ weekday[day];
//document.getElementById("date-box2").innerHTML = ;

var timerVar = setInterval(countTimer, 1000);

var totalSeconds = (d.getHours() * 3600) + (d.getMinutes() * 60) + d.getSeconds();

function countTimer() {

    ++totalSeconds;
    var hour = Math.floor(totalSeconds / 3600);
    var minute = Math.floor((totalSeconds - hour * 3600) / 60);
    var seconds = totalSeconds - (hour * 3600 + minute * 60);

    //document.getElementById("date-box3").innerHTML = ;
    document.getElementById("date-box2").innerHTML = hour + ":"+minute + ":" + seconds;
}


