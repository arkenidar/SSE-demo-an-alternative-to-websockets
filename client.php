<!doctype html>
<html>
<head></head>
<body>
<?php $cid = (int)@$_GET["cid"]; ?>
<div id="warning"></div>
cid: <?php echo $cid; ?> <button onclick="send()">send</button>
<input id="tts">
<a href="client.php?cid=0" target="_blank">0</a> <a href="client.php?cid=1" target="_blank">1</a>
<div id="out"></div>
<script type="text/javascript">
function id(id_to_get){
    return document.getElementById(id_to_get)
}

function warning_tag(html_to_write){
    id('warning').innerHTML += html_to_write+'<br>'
}

function warn(warning){
    //warning_tag(warning)
    console.log(warning)
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
var tts = id('tts').value
id('tts').value=''
get('insert.php?msg='+tts+'&cids=1,2', function(){})
}

var source = new EventSource('sse.php?cid='+'<?php echo $cid; ?>')
source.onmessage = function (event) {
    var msg_type = event.data[0]
    var data = event.data.slice(1)
    if(msg_type=='M'){
        //alert(data);
        document.title = data
        id('out').innerHTML += data.replace(/</g, "&lt;").replace(/>/g, "&gt;")+'<br>'
    }else if(msg_type=='E'){
        console.log(data)
    }
}
</script>
</body>
</html>