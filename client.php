<!doctype html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>
</head>

<body>
<?php
$cid = (int)@$_GET['cid'];
$console_tag_enabled = (int)@$_GET['console'];
?>

<div id="console"></div>
<button onclick="location.reload()">cid: <?php echo $cid; ?></button> <a href="client.php?cid=0" target="_blank">0</a> <a href="client.php?cid=1" target="_blank">1</a> <br>
<input id="tts"> <button id="send">send</button>
<div id="out"></div>

<script type="text/javascript">
function module(){

var console_tag_enabled = (<?php echo $console_tag_enabled; ?>)!=0;

function escape_html_tag(unescaped_text){
    return unescaped_text.replace(/</g, "&lt;").replace(/>/g, "&gt;")
}

function id(id_to_get){
    return document.getElementById(id_to_get)
}

function console_tag(html_to_write){
    id('console').innerHTML += escape_html_tag(html_to_write) + '<br>'
}

function log(text_to_log){
    if(console_tag_enabled) console_tag(text_to_log)
    console.log(text_to_log)
}

function get(url_to_get, success_cb){
    var xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            success_cb(xhttp.responseText)
        }
    }
    xhttp.open("GET", url_to_get, true)
    xhttp.send()
}

function send(){
    log('send')
    
    var tts = id('tts').value
    id('tts').value=''

    var jqxhr = $.get( 'insert.php?msg='+tts+'&cids=0,1', function() {
        log('insert successful:' + tts)
    })
    .fail(function() {
        log('ajax error in insert:' + tts)
    })
}

var source_demo = 'demo_sse.php'
var source_app = 'sse.php?cid='+'<?php echo $cid; ?>'

var event_source = new EventSource(source_app);
event_source.onmessage = function (event) {
   //log('event.data: '+event.data)
   document.getElementById("out").innerHTML += escape_html_tag(event.data) + '<br>';
}

log('EventSource present?:'+('EventSource' in window))
event_source.onmessage = function (event) {
    var data = event.data;
    //log('onmessage:'+data)
    var msg_type = data[0]
    var data = data.slice(1)
    if(msg_type=='M'){
        //alert(data);
        document.title = data
        id('out').innerHTML += escape_html_tag(data) + '<br>'
    }else if(msg_type=='E'){
        log(data)
    }
}

log('initialized')
$('button#send').click(send)

} // end of module function
$(module)
</script>
</body>
</html>