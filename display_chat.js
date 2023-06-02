function refresh() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('chat_box').innerHTML = xhr.responseText;              
        }
    }
   
    xhr.open('GET', 'display chat.php', true);
    xhr.send();
}

setInterval(refresh, 500);