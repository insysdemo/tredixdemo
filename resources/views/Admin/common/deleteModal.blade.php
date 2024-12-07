<div class="modal-body">
    <p style="color:black;">Are you sure  you want to delete this record!</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger"  data-method="{{ $data['type'] }}"
    data-target="commonModal"  onclick="deleteReocrd(this)" data-url="{{ $data['url'] }}">Delete</button>
    <button type="button" class="btn btn-primary light"  data-dismiss="modal" onclick="hideDiv(this)" >Close</button>
</div>
