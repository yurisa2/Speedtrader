var start_js = 0;
var increm = 0;
var rolling;
var size_c;

function setStart(start,size) {

  start_js = start;
  increm = start;
  size_c = size;
  hide_commands();
}

function NewChart() {
  document.getElementById("chart").src = "ohlc.php?start=" + increm ;
  increm = increm + 1;
  document.getElementById("counter").innerHTML = (increm - start_js);
  $(".progress .progress-bar").css('width', (increm - start_js));
  if((increm - start_js) == 12)
  {
    document.getElementById("counter").innerHTML = "New Game";

    the_end_session();
  }
}

function Play() {
  document.getElementById('play').style.visibility = 'hidden';
  document.getElementById('stop').style.visibility = 'visible';
  show_commands();

  rolling = setInterval(NewChart, 400);
}

function Stop() {
  document.getElementById('stop').style.visibility = 'hidden';
  document.getElementById('play').style.visibility = 'visible';
  hide_commands();

  clearTimeout(rolling);
  rolling = undefined;
}

function hide_commands()
{
  document.getElementById('btn_sell').style.visibility = 'hidden';
  document.getElementById('btn_buy').style.visibility = 'hidden';
  document.getElementById('btn_close').style.visibility = 'hidden';
}

function show_commands()
{
  document.getElementById('btn_sell').style.visibility = 'visible';
  document.getElementById('btn_buy').style.visibility = 'visible';
  document.getElementById('btn_close').style.visibility = 'visible';
}

function Rolling() {
  // document.getElementById("counter").innerHTML = rolling;
}

function get_new_session() {

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "operator.php?op=new_session", true);
  xmlhttp.send();

}

function the_end_session() {

  Stop();
  document.getElementById('play').style.visibility = 'hidden';
  document.getElementById('stop').style.visibility = 'hidden';
  document.getElementById('btn_sell').style.visibility = 'hidden';
  document.getElementById('btn_buy').style.visibility = 'hidden';
  get_extract();

  get_new_session();
}

function get_extract() {

  var xmlhttp3 = new XMLHttpRequest();

  xmlhttp3.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("extract").innerHTML = this.responseText;
    }
  };

  xmlhttp3.open("GET", "extract.php", true);
  xmlhttp3.send();
}
