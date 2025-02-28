
  //Delete js code hian uay
  deletes = document.getElementsByClassName("delete");
  Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("edit" ,);
      tr = e.target.parentNode.parentNode;
  
      sno = e.target.id.substr(1,);
  
  
      if(confirm("Are You want to shure to delete!")){
        console.log("yes");
        window.location = `/crud/index.php?delete=${sno}`;
      }else
      {
        console.log("no");
      }
    });
  });