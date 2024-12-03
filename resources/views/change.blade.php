<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Change Passsword</h4>
      </div>
      {!! Form::open(array('route' => 'change.password','method'=>'POST')) !!}
      <div class="modal-body">
      <div class="form-group">
        <label>New Password:</label>
        <input type="password" name="password" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" required="">
      </div>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> Cancel</button>
           <button class="btn btn-danger" type="submit"><span class='glyphicon glyphicon-ok'></span> Change Password</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
<script type="text/javascript">
     $('#password_change').on('click', function() {
      $('#change_password').modal('show');
      });
</script>