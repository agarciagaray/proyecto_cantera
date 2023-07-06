<!-- Modal -->

<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <b><h5 class="modal-title " id="modalTitle"></h5></b>
                <button type="button" class="close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="listMessageErrors">
                <div class="messages"></div>
                <div class="messageUnique"></div>
            </div>
            <div class="modal-body" id="adminModalBody">
      
                @yield('form')
            </div>
        </div>
    </div>
</div>