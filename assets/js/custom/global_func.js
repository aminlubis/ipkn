$(document).ready(function() {
    $('#page-area-content').load('dashboard/chart?_=' + (new Date()).getTime());
});

function show_modal(url, title){

    preventDefault();

    $('#text_title').text(title);

    $('#global_modal_content_detail').load(url); 

    $("#globalModalView").modal();

}

function PopupCenter(url, title, w, h) {
// Fixes dual-screen position                         Most browsers      Firefox
var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

var left = ((width / 2) - (w / 2)) + dualScreenLeft;
var top = ((height / 2) - (h / 2)) + dualScreenTop;
var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

// Puts focus on the newWindow
if (window.focus) {
    newWindow.focus();
}

/*custom hide after show popup*/
$('#modalCetakTracer').modal('hide');
}

function preventDefault(e) {
e = e || window.event;
if (e.preventDefault)
    e.preventDefault();
e.returnValue = false;  
}

function hitung_usia(DOB){

var today = new Date(); 
var d = DOB;
if (!/\d{4}\-\d{2}\-\d{2}/.test(d)) {   // check valid format
return false;
}
d = d.split("-");

var byr = parseInt(d[0]); 
var nowyear = today.getFullYear();
if (byr >= nowyear || byr < 1900) {  // check valid year
return false;
}

var bmth = parseInt(d[1],10)-1;  
if (bmth<0 || bmth>11) {  // check valid month 0-11
return false;
}

var bdy = parseInt(d[2],10); 
if (bdy<1 || bdy>31) {  // check valid date according to month
return false;
}

var age = nowyear - byr;
var nowmonth = today.getMonth();
var nowday = today.getDate();
if (bmth > nowmonth) {age = age - 1}  // next birthday not yet reached
else if (bmth == nowmonth && nowday < bdy) {age = age - 1}

return age;
//alert('You are ' + age + ' years old'); 
}

function getAge(paramsDate, style) {

var dateString = getFormattedDate(paramsDate);

var now = new Date();
var today = new Date(now.getYear(),now.getMonth(),now.getDate());

var yearNow = now.getYear();
var monthNow = now.getMonth();
var dateNow = now.getDate();

var dob = new Date(dateString.substring(6,10),
                dateString.substring(0,2)-1,                   
                dateString.substring(3,5)                  
                );

var yearDob = dob.getYear();
var monthDob = dob.getMonth();
var dateDob = dob.getDate();
var age = {};
var ageString = "";
var yearString = "";
var monthString = "";
var dayString = "";


yearAge = yearNow - yearDob;

if (monthNow >= monthDob)
var monthAge = monthNow - monthDob;
else {
yearAge--;
var monthAge = 12 + monthNow -monthDob;
}

if (dateNow >= dateDob)
var dateAge = dateNow - dateDob;
else {
monthAge--;
var dateAge = 31 + dateNow - dateDob;

if (monthAge < 0) {
    monthAge = 11;
    yearAge--;
}
}

age = {
    years: yearAge,
    months: monthAge,
    days: dateAge
    };

if ( age.years > 1 ) yearString = " thn";
else yearString = " thn";
if ( age.months> 1 ) monthString = " bln";
else monthString = " bln";
if ( age.days > 1 ) dayString = " hr";
else dayString = " hr";


if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
ageString = age.years + yearString + ", " + age.months + monthString + ", " + age.days + dayString + " ";
else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
ageString = "" + age.days + dayString + " ";
else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
ageString = age.years + yearString + " Happy Birthday!!";
else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
ageString = age.years + yearString + ",  " + age.months + monthString + " ";
else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
ageString = age.months + monthString + ", " + age.days + dayString + " ";
else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
ageString = age.years + yearString + ", " + age.days + dayString + " ";
else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
ageString = age.months + monthString + " ";
else ageString = "Oops! Could not calculate age!";

if(style==1){
return ageString;
}else{
return age.years;
}

}

function getFormattedDate(paramsDate) {
var date = new Date(paramsDate);
let year = date.getFullYear();
let month = (1 + date.getMonth()).toString().padStart(2, '0');
let day = date.getDate().toString().padStart(2, '0');        
return month + '/' + day + '/' + year;
}

function getFormatSqlDate(paramsDate) {
var date = new Date(paramsDate);
let year = date.getFullYear();
let month = (1 + date.getMonth()).toString().padStart(2, '0');
let day = date.getDate().toString().padStart(2, '0');        
return year + '-' + month + '-' + date;
}

function formatMoney(number){
money = new Intl.NumberFormat().format(number);
format = 'Rp. ' +money+ ',-';
return format;
}

function sumClass(classname){

var sum = 0;

$("."+classname).each(function() {
    var val = $.trim( $(this).val() );
    
    if ( val ) {
        val = parseFloat( val.replace( /^\$/, "" ) );
    
        sum += !isNaN( val ) ? val : 0;
    }
});


return sum;
}
