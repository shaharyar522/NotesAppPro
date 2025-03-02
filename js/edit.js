document.querySelectorAll('.edit').forEach(button => {
  button.addEventListener('click', function() {
      let row = this.closest('tr');
      let sno = this.id;
      let title = row.cells[1].innerText;
      let description = row.cells[2].innerText;
      let image = row.cells[3].querySelector('img') ? row.cells[3].querySelector('img').src : '';

      document.getElementById('snoEdit').value = sno;
      document.getElementById('titleEdit').value = title;
      document.getElementById('descriptionEdit').value = description;
      document.getElementById('currentImage').value = image; // Set the current image

      var editModal = new bootstrap.Modal(document.getElementById('editModal'));
      editModal.show();
  });
});