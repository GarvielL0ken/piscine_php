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
            var item_str = arr_text[i].split(';');
            addListItem(item_str[0], item_str[1]);
        }
    }
}

function promptListItem()
{
    var userListItem = prompt("Enter a new item for the to do list", "skydiving");
    if (userListItem != null && userListItem != '')
    {
        var id = parseInt(list[0].childNodes[0].id) + 1;
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