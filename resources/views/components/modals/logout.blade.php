<div class="modal" tabindex="-1" id="logout-modal">
    <div class="modal-dialog">

        <form class="modal-content" action="{{ route('logout') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout? You can't access some of promised functionalities if you logout.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nevemind</button>
                <button class="btn btn-danger">Sure</button>
            </div>
        </form>
    </div>
</div>