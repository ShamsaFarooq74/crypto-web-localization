<div class="modal" tabindex="-1" id="delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p> Are you sure you want to delete this item?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="deleteItem()">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
  function confirmDelete() {
    $('#delete-modal').modal('show');

  }

  function deleteItem() {
    $('#delete-form').submit();
  }
</script>
