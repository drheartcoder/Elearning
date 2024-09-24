/*alert($('#hiddenTemplate').val());*/
if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==1)
{
    $(document).on('change', '#fileType', function(){
        var fileType = $(this).val();
        if(fileType!='')
        {
            if(fileType == 'image')
            {
                $('#divVideo').hide();
                $('#divImage').show();
            }
            else if(fileType == 'video')
            {
                $('#divImage').hide();
                $('#divVideo').show();
            }
        }
        else
        {
            $('#err_fileType').html('This field is required.');
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==2)
{
    
}
