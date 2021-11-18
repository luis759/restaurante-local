<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="10000" style="position: absolute; top: 0; right: 0;"> 
  <div class="toast-header">
    <strong class="mr-auto">{{ config('app.name', 'Laravel') }}</strong>
    <small>Recent</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body" id="toastMessage">
  </div>
</div>