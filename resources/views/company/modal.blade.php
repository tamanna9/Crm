<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header bcg-green">
      <i class="fa fa-plus text-white"></i>
      <h3 class="modal-title display-inline font-bold pull-left" id="exampleModalLabel">Add Company</h3>
    </div>
    <div class="modal-body">
      <form id="comapny-form" enctype="multipart/form-data">
          @csrf
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">Name
            <span class="required" aria-required="true"> * </span>
          </label>
          <input type="text" class="form-control" name="name">
          <input type="hidden" class="form-control" name="type" value="save">
         
          <span data-name="name" class="error red-color"></span>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">Email
          </label>
          <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">Logo
          </label>
          <input type="file" class="form-control" name="logo" accept="image/png, image/gif, image/jpeg" height="100" width="100" onchange="uploadPhotos($event)">
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">address
          </label>
          <input type="text" class="form-control" name="address">
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">Website
            <span class="required" aria-required="true"> </span>
          </label>
          <input type="text" class="form-control" name="website">
        
        </div>
      </form>
    </div>
    <div class="modal-footer center">
      <button type="button" id="save-comapny-form-button" class="btn btn-primary">Add</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>
  </div>
</div>