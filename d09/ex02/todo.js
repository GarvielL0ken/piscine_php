var list_index = 0;

window.onload = function()
{
    var button = document.getElementById('new');
    button.addEventListener('click', promptToDo);
}

function promptToDo()
{
    var userToDo = prompt("Enter a new item for the to do list", "skydiving");
    if (userToDo != null && userToDo != '')
        addToDo(userToDo);
}

function addToDo(userToDo)
{
    var list = document.getElementById('ft_list');
    var newItem = document.createElement('div');
    var newText = document.createTextNode(userToDo);
    newItem.appendChild(newText);
    newItem.onclick = function() {
        removeListItem(this);
    };
    list.insertBefore(newItem, list.childNodes[0]);
    list_index++;
    saveToCookie();
}

function removeListItem(item)
{
    if (confirm("Are you sure you want to remove this item?"))
        item.remove();
}

function saveToCookie(){
    var ft_list = document.getElementById('ft_list');
    var todo = ft_list.children;
    var newCookie = [];
    for (var i = 0; i < todo.length; i++)
        newCookie.unshift(todo[i].innerHTML);
    document.cookie= "todos=" + JSON.stringify(newCookie);
    cookie = document.cookie;
    console.log(cookie);
};