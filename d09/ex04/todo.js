$(document).ready(function() 
{
    $("button").click(promptListItem);
    list = $("#ft_list");
    createList;
    $.get('select.php', function(data){
        createList(data);
    })
});

function createList(list_str)
{
    if (list_str != "")
    {
        arr_text = list_str.split("\n");
        for (var i = arr_text.length - 1; i >= 0; i--)
        {
            var item_str = CSVtoArray(arr_text[i]);
            addListItem(item_str[0], item_str[1]);
        }
    }
}

function promptListItem()
{
    var userListItem = prompt("Enter a new item for the to do list", "skydiving");
    if (userListItem != null && userListItem != '')
    {
        if (list[0].childNodes[0] != null)
            var id = parseInt(list[0].childNodes[0].id) + 1;
        else
            id = 0;
        $.get('insert.php?id=' + id + '&value=' + userListItem);
        addListItem(id, userListItem);
    }
}

function addListItem(strId, userListItem)
{
    var newItem = $("<div id= " + strId + "></div>").click(removeListItem);
    var newText = $(document.createTextNode(userListItem));
    newItem.prepend(newText)
    list.prepend(newItem);
}

function removeListItem()
{
    if (confirm("Are you sure you want to remove this item?"))
    {
        $.get('delete.php?id=' + this.id);
        this.remove();
    }
}

function CSVtoArray(text) {
    var re_valid = /^\s*(?:'[^'\\]*(?:\\[\S\s][^'\\]*)*'|"[^"\\]*(?:\\[\S\s][^"\\]*)*"|[^;'"\s\\]*(?:\s+[^;'"\s\\]+)*)\s*(?:;\s*(?:'[^'\\]*(?:\\[\S\s][^'\\]*)*'|"[^"\\]*(?:\\[\S\s][^"\\]*)*"|[^;'"\s\\]*(?:\s+[^;'"\s\\]+)*)\s*)*$/;
    var re_value = /(?!\s*$)\s*(?:'([^'\\]*(?:\\[\S\s][^'\\]*)*)'|"([^"\\]*(?:\\[\S\s][^"\\]*)*)"|([^;'"\s\\]*(?:\s+[^;'"\s\\]+)*))\s*(?:;|$)/g;
    if (!re_valid.test(text)) return null;
    var a = [];
    text.replace(re_value, function(m0, m1, m2, m3) {
            if      (m1 !== undefined) a.push(m1.replace(/\\'/g, "'"));
            else if (m2 !== undefined) a.push(m2.replace(/\\"/g, '"'));
            else if (m3 !== undefined) a.push(m3);
            return '';
        });
    if (/;\s*$/.test(text)) a.push('');
    return a;
};
