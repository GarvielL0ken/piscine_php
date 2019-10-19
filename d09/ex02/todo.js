var list_index = 0;

window.onload = function()
{
    var button = document.getElementById('new');
    button.addEventListener('click', promptToDo);
    createList();
}

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

function promptToDo()
{
    var userToDo = prompt("Enter a new item for the to do list", "skydiving");
    if (userToDo != null && userToDo != '')
        addListItem(userToDo);
}

function addListItem(userToDo)
{
    var list = document.getElementById('ft_list');
    var newItem = document.createElement('div');
    var newText = document.createTextNode(userToDo);
    newItem.appendChild(newText);
    newItem.id = list_index;
    newItem.onclick = function() {
        removeListItem(this);
    };
    list.insertBefore(newItem, list.childNodes[0]);
    list_index++;
    setCookie();
}

function removeListItem(item)
{
    if (confirm("Are you sure you want to remove this item?"))
        item.remove();
}

function setCookie(){
    var cookie = "list_items= ";
    var list_items = document.getElementById("ft_list");
    list_items = list_items.children;
    for (var i = list_items.length - 1; i >= 0; i--)
    {
        var div = document.getElementById(i);
        cookie = cookie + ',' + div.innerText;
    }
    document.cookie = cookie;
};