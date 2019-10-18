var list_index = 0;

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
        var id = 0;
        for (var i = list[0].childElementCount - 1; i >= 0; i--)
        {
            if (list[0].childNodes[i].id != id)
                break ;
            id++;
        }
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

// function setCookie(){
//     var cookie = "list_items= ";
//     cookie = cookie + list_items[0].innerText;
//     for (var i = 1; i < list_items.length; i++)
//     {
//         cookie = cookie + ',' + list_items[i].innerText;
//     }
//     document.cookie = cookie;
// };