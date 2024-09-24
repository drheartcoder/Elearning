 @if(Session::has('success'))
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span>
      <b> Success - </b> {{ Session::get('success') }}</span>
  </div>
@endif  

@if(Session::has('error'))
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span>
      <b> Danger - </b> {{ Session::get('error') }}</span>
  </div>
@endif

@if(Session::has('warning'))
  <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span>
      <b> Warning - </b> {{ Session::get('warning') }}</span>
  </div>
@endif


@if(Session::has('success_password'))
<div class="alert alert-success alert-dismissible">
 <a href="#" class="close close-btn" data-dismiss="alert" aria-label="close">&times;</a>
 {{ Session::get('success_password') }}
</div>
@endif  

@if(Session::has('error_password'))
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close close-btn" data-dismiss="alert" aria-label="close">&times;</a>
  {{ Session::get('error_password') }}
</div>
@endif
<style type="text/css">
  .close-btn
  {
    padding: 10px!important;
  }

  .close-btn1
  {
    padding-top: 2px;
    padding-right: 10px;
  }

</style>
