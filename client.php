<script>
function send(){
var tts = document.all.tts.value
fetch('insert.php?msg='+tts+'&cids=1,2')
}
const source = new EventSource('sse.php?cid='+'<?=isset($_REQUEST["cid"])?(int)$_REQUEST["cid"]:1?>')
source.onmessage = function (event) {
    //alert(event.data);
    document.title = event.data
    document.all.out.innerHTML += event.data+'<br>'
}
</script>
<button onclick=send()>send</button>
<input id=tts>
<a href=client.php?cid=1 target=_blank>1</a> <a href=client.php?cid=2 target=_blank>2</a>
<div id=out></div>
