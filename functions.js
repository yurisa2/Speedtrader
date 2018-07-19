var start_js = 0;
var increm = 0;
var rolling;
var size_c;

function setStart(start,size) {
start_js = start;
increm = start;
size_c = size;
document.getElementById('stop').style.visibility = 'hidden';
document.getElementById('btn_sell').style.visibility = 'hidden';
document.getElementById('btn_buy').style.visibility = 'hidden';
}

function NewChart() {
    document.getElementById("chart").src = "ohlc.php?start=" + increm + "&size=" + size_c;
    increm = increm + 1;
    document.getElementById("counter").innerHTML = (increm - start_js);

}

function Play() {
document.getElementById('play').style.visibility = 'hidden';
document.getElementById('stop').style.visibility = 'visible';
document.getElementById('btn_sell').style.visibility = 'visible';
document.getElementById('btn_buy').style.visibility = 'visible';

rolling = setInterval(NewChart, 400);
}

function Stop() {
document.getElementById('stop').style.visibility = 'hidden';
document.getElementById('play').style.visibility = 'visible';
document.getElementById('btn_sell').style.visibility = 'hidden';
document.getElementById('btn_buy').style.visibility = 'hidden';

clearTimeout(rolling);
rolling = undefined;
}

function Rolling() {
// document.getElementById("counter").innerHTML = rolling;
}
