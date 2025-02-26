// we have a button include class
// whic is name is edit
//Edit js
edits = document.getElementsByClassName("edit");
Array.from(edits).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("edit");
    tr = e.target.parentNode.parentNode;
    title = tr.getElementsByTagName("td")[0].innerText;
    description = tr.getElementsByTagName("td")[1].innerText;
    console.log(title, description);
    titleEdit.value = title;
    descriptionEdit.value = description;
    snoEdit.value = e.target.id;
    console.log(e.target.id);
    $("#editModal").modal("toggle");
  });
});

//Delete js code hian uay

deletes = document.getElementsByClassName("delete");
Array.from(deletes).forEach((element) => {
  element.addEventListener("click", (e) => {
    console.log("edit");
    tr = e.target.parentNode.parentNode;

    sno = e.target.id.substr(1,);
    if (confirm("Press a button!")){
      window.location = `/crud/index.php?delete=${sno}`;
    }else
    {
      console.log("no");
    }
  });
});
