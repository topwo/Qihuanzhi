onmessage =function (evt)
{
    var parameter = evt.data;
    var result;

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open( "GET", "../php/redis_get_" + parameter + ".php", false );
    xmlhttp.send();
    result = xmlhttp.responseText;

    postMessage( result );
}
