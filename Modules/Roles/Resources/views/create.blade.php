<div class="modal animated bounce" id="myModalfour" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('store_roles') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <h2>Add a Role</h2>
                    <input class="form-control form-control-solid" required placeholder="{{ transWord('Enter a role name') }}" name="name" />
                </div>
                <div class="modal-footer" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
