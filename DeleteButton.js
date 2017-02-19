
function DeleteRequest(id,add)
{
    console.log("fuuuuuuuuuck");
	if(confirm("Are you sure you want to delete this row?") == true)
    {
        window.location = add + "?del=" + id;
        return true;
    }

    return false;
}

/*function DeleteRequest2(id,id2,add)
{
    if (confirm("Are you sure you want to delete this row?") == true) {
        window.location = add + "?id=" + id + "&del="+id2;
        return true;
    }

    return false;
}
*/
function EditRequest(id,add)
{
    window.location = add + "?edit=" + id;
}
