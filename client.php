<script>
function send(){
var tts = document.all.tts.value
fetch('insert.php?msg='+tts+'&cids=1,2')
}
const source = new EventSource('sse.php?cid='+'<?=$_REQUEST["cid"]?>')
source.onmessage = function (event) {
    //alert(event.data);
    document.title = event.data
    document.all.out.innerHTML += event.data+'<br>'
}
</script>
<a onclick=send()>send</a>
<input id=tts>
<a href=client.php?cid=1>1</a> <a href=client.php?cid=2>2</a>
<div id=out></div>
