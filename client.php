<?php $cid = isset($_REQUEST["cid"])?(int)$_REQUEST["cid"]:1; ?>
<script>
function send(){
var tts = document.all.tts.value
document.all.tts.value=''
fetch('insert.php?msg='+tts+'&cids=1,2')
}
const source = new EventSource('sse.php?cid='+'<?=$cid?>')
source.onmessage = function (event) {
    const msg_type=event.data[0]
    const data=event.data.slice(1)
    if(msg_type=='M'){
        //alert(data);
        document.title = data
        document.all.out.innerHTML += data.replace(/</g, "&lt;").replace(/>/g, "&gt;")+'<br>'
    }else if(msg_type=='E'){
        console.log(data)
    }
}
</script>
cid: <?=$cid?> <button onclick=send()>send</button>
<input id=tts>
<a href=client.php?cid=1 target=_blank>1</a> <a href=client.php?cid=2 target=_blank>2</a>
<div id=out></div>
