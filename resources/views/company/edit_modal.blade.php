<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header bcg-green">
      <i class="fa fa-plus text-white"></i>
      <h3 class="modal-title display-inline font-bold pull-left" id="exampleModalLabel">Edit Company</h3>
    </div>
    <div class="modal-body">
      <form id="update-comapny-form" enctype="multipart/form-data">
          @csrf
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">Name
            <span class="required" aria-required="true"> * </span>
          </label>
          <input type="text" class="form-control" name="name" value={{$company->name}}>
          <input type="hidden" class="form-control" name="type" value="update">
          <input type="hidden" class="form-control" name="companyId" value="{{$company->id}}">
          <span data-name="name" class="error red-color"></span>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">Email
          </label>
          <input type="text" class="form-control" name="email" value={{$company->email}}>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">Logo
          </label>
          <input type="file" class="form-control" name="logo" accept="image/png, image/gif, image/jpeg" height="100" width="100" onchange="uploadPhotos($event)">
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">address
          </label>
          <input type="text" class="form-control" name="address" value={{$company->address}}>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label control-label">Website
            <span class="required" aria-required="true"> </span>
          </label>
          <input type="text" class="form-control" name="website" value={{$company->website}}>
        
        </div>
      </form>
    </div>
    <div class="modal-footer center">
      <button type="button" data-id="{{$company->id}}" id="update-comapny-form-button" class="btn btn-primary">Update</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>
  </div>
</div>