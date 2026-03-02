<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Delete Product</h2>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete <strong id="productName"></strong>?</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <form id="deleteForm" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-confirm">Delete</button>
            </form>
        </div>
    </div>
</div>