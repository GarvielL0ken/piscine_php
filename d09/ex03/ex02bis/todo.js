var list_index = 0;

$(document).ready(function() 
{
    $("button").click(promptListItem);
    list = $("#ft_list");
    createList();
});

function createList()
{
    cookie = getCookie('list_items');
    if (cookie != "")
    {
        arr_text = cookie.split(',');
        for (var i = arr_text.length - 1; i >= 0; i--)
            addListItem(arr_text[i]);
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) 
    {
      var c = ca[i];
      while (c.charAt(0) == ' ') 
      {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0)
      {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

function promptListItem()
{
    var userListItem = prompt("Enter a new item for the to do list", "skydiving");
    if (userListItem != null && userListItem != '')
        addListItem(userListItem);
}

function addListItem(userListItem)
{
    var newItem = $("<div></div>").click(removeListItem)[0];
    var newText = $(document.createTextNode(userListItem))[0];
    newItem.prepend(newText)
    list.prepend(newItem);
}

function removeListItem()
{
    if (confirm("Are you sure you want to remove this item?"))
        this.remove();
}

function setCookie(){
    var cookie = "list_items= ";
    cookie = cookie + list_items[0].innerText;
    for (var i = 1; i < list_items.length; i++)
    {
        cookie = cookie + ',' + list_items[i].innerText;
    }
    document.cookie = cookie;
};