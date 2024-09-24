function confirm_action(ref,evt,msg)
{
  /*alert(ref+'//'+evt+'//'+msg);*/
   var msg = msg || false;
  
   evt.preventDefault();  
   swal({
              title: 'Are you sure?',
              text: msg,
              type: 'warning',
              showCancelButton: true,
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              confirmButtonText: 'Yes',
              cancelButtonText: 'No',
              buttonsStyling: false
          }).then(function() {
             window.location = $(ref).attr('href');
          }).catch(swal.noop)


  /*  swal({
          title: "Are you sure ?",
          text: msg,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm)
        {
          if(isConfirm==true)
          {
            // swal("Performed!", "Your Action has been performed on that file.", "success");
            window.location = $(ref).attr('href');
          }
        });*/
}    

/*---------- Multi_Action-----------------*/

  function check_multi_action(frm_id,action)
  {
    // var len = $('input[name="'+checked_record+'"]:checked').length;

    var len = $('input[name="checked_record[]"]:checked').length;
    var flag=1;
    var frm_ref = $("#"+frm_id);
    
    if(len<=0)
    {
      swal({    text: "Please select the record to perform this Action.",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success"
            }).catch(swal.noop)
      return false;
    }
    
    if(action=='delete')
    {
      var confirmation_msg = "Do you really want to delete selected record(s) ?";
    }
    else if(action == 'deactivate')
    {
      var confirmation_msg =  "Do you really want to deactivate selected record(s) ?";
    }
    else if(action == 'activate')
    {
      var confirmation_msg =  "Do you really want to activate selected record(s) ?";
    }
    
    /*swal({
          title: "Are you sure ?",
          text: confirmation_msg,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm)
        {
          if(isConfirm)
          {
            $('input[name="multi_action"]').val(action);
            $(frm_ref)[0].submit();
          }
          else
          {
           return false;
          }
        }); */


         swal({
              title: 'Are you sure?',
              text: confirmation_msg,
              type: 'warning',
              showCancelButton: true,
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              confirmButtonText: 'Yes',
              cancelButtonText: 'No',
              buttonsStyling: false,
              closeOnConfirm: true,
              closeOnCancel: true
          }).then(function() {
              $('input[name="multi_action"]').val(action);
              $(frm_ref)[0].submit();
          }).catch(swal.noop)
  }


  /* This function shows simple alert box for showing information */
  function showAlert(msg,type,confirm_btn_txt)
  {
      confirm_btn_txt = confirm_btn_txt || 'Ok';
      swal({
        title: "",
        text: msg,
        type: type,
        confirmButtonText: confirm_btn_txt
      });
      return false; 
  }





