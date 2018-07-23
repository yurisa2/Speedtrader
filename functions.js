var start_js = 0;
var increm = 0;
var rolling;
var size_c;

function setStart(start,size,speed) {

  speed_c = speed;
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

  get_status(increm);
  if((increm - start_js) <= (size_c - 2))  get_trade_controls();

  if((increm - start_js) == size_c)
  {
    document.getElementById("counter").innerHTML = "New Game";

    the_end_session();
  }
}

function Play() {
  document.getElementById('play').style.visibility = 'hidden';
  document.getElementById('stop').style.visibility = 'visible';
  show_commands();

  rolling = setInterval(NewChart, speed_c);
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
  deal_close();
  Stop();
  document.getElementById('play').style.visibility = 'hidden';
  document.getElementById('stop').style.visibility = 'hidden';
  document.getElementById('btn_sell').style.visibility = 'hidden';
  document.getElementById('btn_buy').style.visibility = 'hidden';
  document.getElementById('btn_close').style.visibility = 'hidden';

  get_extract();

  get_new_session();
}

function get_extract() {

  // var xmlhttp3 = new XMLHttpRequest();
  //
  // xmlhttp3.onreadystatechange = function() {
  //   if (this.readyState == 4 && this.status == 200) {
  //     document.getElementById("panel").innerHTML = this.responseText;
  //   }
  // };
  //
  // xmlhttp3.open("GET", "extract.php", true);
  // xmlhttp3.send();
}

function get_status(increm) {

  var xmlhttp3 = new XMLHttpRequest();

  xmlhttp3.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("panel").innerHTML = this.responseText;
    }
  };

  xmlhttp3.open("GET", "status.php?increm=" + increm, true);
  xmlhttp3.send();
}

function deal_buy() {

  var buyer = new XMLHttpRequest();

  document.getElementById('btn_sell').style.visibility = 'hidden';
  document.getElementById('btn_buy').style.visibility = 'hidden';
  document.getElementById('btn_close').style.visibility = 'visible';

  buyer.open("GET", "operator.php?op=open_buy&tick=" + increm, true);
  buyer.send();

}

function deal_sell() {

  var seller = new XMLHttpRequest();

  document.getElementById('btn_sell').style.visibility = 'hidden';
  document.getElementById('btn_buy').style.visibility = 'hidden';
  document.getElementById('btn_close').style.visibility = 'visible';

  seller.open("GET", "operator.php?op=open_sell&tick=" + increm, true);
  seller.send();
}

function deal_close() {

  var close = new XMLHttpRequest();

  close.open("GET", "operator.php?op=deal_close&tick=" + increm, true);
  close.send();
}

function get_trade_controls() {
  $.getJSON("trade_controls.php", function(result){

    if(result.btn_close == true) document.getElementById('btn_close').style.visibility = 'visible';
    if(result.btn_buy == true)   document.getElementById('btn_buy').style.visibility = 'visible';
    if(result.btn_sell == true)    document.getElementById('btn_sell').style.visibility = 'visible';
    if(result.btn_close == false) document.getElementById('btn_close').style.visibility = 'hidden';
    if(result.btn_buy == false)   document.getElementById('btn_buy').style.visibility = 'hidden';
    if(result.btn_sell == false)    document.getElementById('btn_sell').style.visibility = 'hidden';
  });

}
