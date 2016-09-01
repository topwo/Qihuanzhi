<div id="help-cards">

</div>

<script>
getData('data','nav-top-fushi','cards.count');

$('#nav-top-div').html(
    '<img id="nav-top-button" src="../img/ui/button_hero.png">'
);

function card(num)
{
    alert(num);
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
                '<img onclick="card('+i+')" src="../img/avater/'+i+'.png" class="card"></img>'
            );
        }
    };
}
</script>
