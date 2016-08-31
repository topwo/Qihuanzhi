function getHtml(url)
{
    htmlobj = $.ajax({
        dateType: "html",
        url: url,
        async: false,
        success: function(XMLHttpRequest, textStatus)
        {
            document.write(XMLHttpRequest);
        },
    });
}
