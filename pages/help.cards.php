<div id="help-cards">

</div>

<script>
getData('data','nav-top-fushi','cards.count');

$('#nav-top-div').html(
    '<img id="nav-top-button" src="../img/ui/button_hero.png">'
);

function card(key,value)
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("GET","../pages/cards.detail.php?key="+key+"&value="+value,true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            $('body').append(xmlhttp.responseText);
        }
    }
}

function getData(model,div,name)
{
    var worker = new Worker("../js/work.js");
    worker.postMessage( model );
    worker.onmessage = function(evt)
    {
        var result = jQuery.parseJSON( evt.data );
        for (var i = 1; i <= result['cards.count']; i++) {
            $("#help-cards").append(
                '<img onclick="card(\''+'all\','+i+')" src="../img/avater/'+i+'.png" class="card"></img>'
            );
        }
    };
}
</script>
