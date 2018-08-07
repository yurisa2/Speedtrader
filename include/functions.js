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
  document.getElementById('btn_end_session').style.visibility = 'false';
  document.getElementById('settings_panel').style.visibility = 'hidden';

}

function NewChart() {
  document.getElementById("chart").src = "ohlc.php?start=" + increm ;
  increm = increm + 1;
  document.getElementById("counter").innerHTML = (increm - start_js);
  // $(".progress .progress-bar").css('width', (increm - start_js));
  $(".progress .progress-bar").attr('aria-valuenow', (increm - start_js)).css('width',(increm - start_js)+ "%");


  document.getElementById('btn_end_session').style.visibility = 'visible';

  get_status(increm);
  if((increm - start_js) <= (size_c - 2))  get_trade_controls();

  get_settings_controls();

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
  document.getElementById('btn_ohlc').style.visibility = 'hidden';
  document.getElementById('btn_candlesticks').style.visibility = 'hidden';
  document.getElementById('btn_end_session').style.visibility = 'hidden';

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
  get_extract();
  document.getElementById('play').style.visibility = 'hidden';
  document.getElementById('stop').style.visibility = 'hidden';
  document.getElementById('btn_sell').style.visibility = 'hidden';
  document.getElementById('btn_buy').style.visibility = 'hidden';
  document.getElementById('btn_close').style.visibility = 'hidden';
  document.getElementById('btn_end_session').style.visibility = 'hidden';
  document.getElementById("counter").innerHTML = "New Game";

  // document.getElementById('counter').style.visibility = 'hidden';
  document.getElementById('pg_bar').style.visibility = 'hidden';
  document.getElementById('progress').style.visibility = 'hidden';
  document.getElementById('settings_panel').style.visibility = 'hidden';
  document.getElementById('panel').style.visibility = 'hidden';

  get_new_session();
  // location.reload(true);
}

function get_extract() {

  var extract = new XMLHttpRequest();

  extract.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("theater").innerHTML = this.responseText;
    }
  };

  extract.open("GET", "extract.php", true);
  extract.send();
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

function get_settings_controls() {
  $.getJSON("settings_controls.php", function(stns_controls){

    if(stns_controls.btn_ohlc == true) document.getElementById('btn_ohlc').style.visibility = 'visible';
    if(stns_controls.btn_candlesticks == true)   document.getElementById('btn_candlesticks').style.visibility = 'visible';
    if(stns_controls.btn_ohlc == false) document.getElementById('btn_ohlc').style.visibility = 'hidden';
    if(stns_controls.btn_candlesticks == false)   document.getElementById('btn_candlesticks').style.visibility = 'hidden';

  });

}


function change_style_ohlc() {

  var change_style_ohlc = new XMLHttpRequest();

  change_style_ohlc.open("GET", "operator.php?op=change_style&style=ohlc", true);
  change_style_ohlc.send();
}

function change_style_candlesticks() {

  var change_style_candlesticks = new XMLHttpRequest();

  change_style_candlesticks.open("GET", "operator.php?op=change_style&style=candlesticks", true);
  change_style_candlesticks.send();
}
