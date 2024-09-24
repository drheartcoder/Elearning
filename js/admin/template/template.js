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
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
    $(document).on('blur', '#question', function(){
        $('#btnGenerate').trigger('click');
    });
    $(document).on('click', '#btnGenerate', function(){
        var question = $('#question').val();
        if(question!='' && question.length > 0)
        {
            var strDivBlankLetter = '';
            for(var i = 0; i < question.length; i++)
            {
                if(question[i]!='')
                {
                    strDivBlankLetter+='<div class="alphabate-letter-section"><input type="text" name="blankLetter[]" class="form-control blankLetter" id="blankLetter'+i+'" maxlength="1" value="'+question[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter[]" id="chkBlankLetter'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter'+i+'"></label></div></div>';
                }
            }
            if(strDivBlankLetter!='')
            {
                $('#wrapperDivBlankLetter').show();
                $('#divBlankLetter').html(strDivBlankLetter);

            }
        }
        else
        {
            $('#divBlankLetter').html('');
            $('#err_question').html('This field is required.');
            $('#wrapperDivBlankLetter').hide();
            return false;
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==3)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==4)
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
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==5)
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
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==6)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==7)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==8)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==9)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });   
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==10)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==11)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==12)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==13)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==14)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==15)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
    $(document).on('blur', '#question1', function(){
       $('#btnGenerate1').trigger('click');
    });
    $(document).on('click', '#btnGenerate1', function(){
        var question1 = $('#question1').val();
        if(question1!='' && question1.length > 0)
        {
            var strDivBlankLetter = '';
            for(var i = 0; i < question1.length; i++)
            {
                if(question1[i]!='')
                {
                    strDivBlankLetter+='<div class="alphabate-letter-section"><input type="text" name="rdoQuestion1Text[]" class="form-control" maxlength="1" value="'+question1[i]+'" /><div class="radio-btns"><div class="radio-btn radio-first-option"><input type="radio" id="rdoQuestion1_'+i+'" name="rdoQuestion1" value="'+i+'"><label for="rdoQuestion1_'+i+'">&nbsp;</label><div class="check"></div></div></div></div>';
                }
            }
            if(strDivBlankLetter!='')
            {
                $('#divBlankLetterWrapper1').show();
                $('#divBlankLetterSubWrapper1').html(strDivBlankLetter);
            }
        }
        else
        {
            $('#divBlankLetterSubWrapper1').html('');
            $('#err_question1').html('This field is required.');
            $('#divBlankLetterWrapper1').hide();
            return false;
        }
    });
    $(document).on('blur', '#question2', function(){
       $('#btnGenerate2').trigger('click');
    });
    $(document).on('click', '#btnGenerate2', function(){
        var question2 = $('#question2').val();
        if(question2!='' && question2.length > 0)
        {
            var strDivBlankLetter = '';
            for(var i = 0; i < question2.length; i++)
            {
                if(question2[i]!='')
                {
                    strDivBlankLetter+='<div class="alphabate-letter-section"><input type="text" name="rdoQuestion2Text[]" class="form-control" maxlength="1" value="'+question2[i]+'" /><div class="radio-btns"><div class="radio-btn radio-first-option"><input type="radio" id="rdoQuestion2_'+i+'" name="rdoQuestion2" value="'+i+'"><label for="rdoQuestion2_'+i+'">&nbsp;</label><div class="check"></div></div></div></div>';
                }
            }
            if(strDivBlankLetter!='')
            {
                $('#divBlankLetterWrapper2').show();
                $('#divBlankLetterSubWrapper2').html(strDivBlankLetter);
            }
        }
        else
        {
            $('#divBlankLetterSubWrapper2').html('');
            $('#err_question2').html('This field is required.');
            $('#divBlankLetterWrapper2').hide();
            return false;
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==16)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==17)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==18)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
    $(document).on('blur', '#question1', function(){
        $('#btnGenerate1').trigger('click');
    });
    $(document).on('click', '#btnGenerate1', function(){
        var question1 = $('#question1').val();
        if(question1!='' && question1.length > 0)
        {
            var strDivBlankLetter1 = '';
            for(var i = 0; i < question1.length; i++)
            {
                if(question1[i]!='')
                {
                    strDivBlankLetter1+='<div class="alphabate-letter-section"><input type="text" name="blankLetter1[]" class="form-control blankLetter" id="blankLetter1_'+i+'" maxlength="1" value="'+question1[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter1[]" id="chkBlankLetter1_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter1_'+i+'"></label></div></div>';
                }
            }
            if(strDivBlankLetter1!='')
            {
                $('#wrapperDivBlankLetter1').show();
                $('#divBlankLetter1').html(strDivBlankLetter1);

            }
        }
        else
        {
            $('#divBlankLetter1').html('');
            $('#err_question1').html('This field is required.');
            $('#wrapperDivBlankLetter1').hide();
            return false;
        }
    });
    $(document).on('blur', '#question2', function(){
        $('#btnGenerate2').trigger('click');
    });
    $(document).on('click', '#btnGenerate2', function(){
        var question2 = $('#question2').val();
        if(question2!='' && question2.length > 0)
        {
            var strDivBlankLetter2 = '';
            for(var i = 0; i < question2.length; i++)
            {
                if(question2[i]!='')
                {
                    strDivBlankLetter2+='<div class="alphabate-letter-section"><input type="text" name="blankLetter2[]" class="form-control blankLetter" id="blankLetter2_'+i+'" maxlength="1" value="'+question2[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter2[]" id="chkBlankLetter2_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter2_'+i+'"></label></div></div>';
                }
            }
            if(strDivBlankLetter2!='')
            {
                $('#wrapperDivBlankLetter2').show();
                $('#divBlankLetter2').html(strDivBlankLetter2);

            }
        }
        else
        {
            $('#divBlankLetter2').html('');
            $('#err_question2').html('This field is required.');
            $('#wrapperDivBlankLetter2').hide();
            return false;
        }
    });
    $(document).on('blur', '#question3', function(){
        $('#btnGenerate3').trigger('click');
    });
    $(document).on('click', '#btnGenerate3', function(){
        var question3 = $('#question3').val();
        if(question3!='' && question3.length > 0)
        {
            var strDivBlankLetter3 = '';
            for(var i = 0; i < question3.length; i++)
            {
                if(question3[i]!='')
                {
                    strDivBlankLetter3+='<div class="alphabate-letter-section"><input type="text" name="blankLetter3[]" class="form-control blankLetter" id="blankLetter3_'+i+'" maxlength="1" value="'+question3[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter3[]" id="chkBlankLetter3_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter3_'+i+'"></label></div></div>';
                }
            }
            if(strDivBlankLetter3!='')
            {
                $('#wrapperDivBlankLetter3').show();
                $('#divBlankLetter3').html(strDivBlankLetter3);

            }
        }
        else
        {
            $('#divBlankLetter3').html('');
            $('#err_question3').html('This field is required.');
            $('#wrapperDivBlankLetter3').hide();
            return false;
        }
    });
    $(document).on('blur', '#question4', function(){
        $('#btnGenerate4').trigger('click');
    });
    $(document).on('click', '#btnGenerate4', function(){
        var question4 = $('#question4').val();
        if(question4!='' && question4.length > 0)
        {
            var strDivBlankLetter4 = '';
            for(var i = 0; i < question4.length; i++)
            {
                if(question4[i]!='')
                {
                    strDivBlankLetter4+='<div class="alphabate-letter-section"><input type="text" name="blankLetter4[]" class="form-control blankLetter" id="blankLetter4_'+i+'" maxlength="1" value="'+question4[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter4[]" id="chkBlankLetter4_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter4_'+i+'"></label></div></div>';
                }
            }
            if(strDivBlankLetter4!='')
            {
                $('#wrapperDivBlankLetter4').show();
                $('#divBlankLetter4').html(strDivBlankLetter4);
            }
        }
        else
        {
            $('#divBlankLetter4').html('');
            $('#err_question4').html('This field is required.');
            $('#wrapperDivBlankLetter4').hide();
            return false;
        }
    });
    $(document).on('blur', '#question5', function(){
        $('#btnGenerate5').trigger('click');
    });
    $(document).on('click', '#btnGenerate5', function(){
        var question5 = $('#question5').val();
        if(question5!='' && question5.length > 0)
        {
            var strDivBlankLetter5 = '';
            for(var i = 0; i < question5.length; i++)
            {
                if(question5[i]!='')
                {
                    strDivBlankLetter5+='<div class="alphabate-letter-section"><input type="text" name="blankLetter5[]" class="form-control blankLetter" id="blankLetter5_'+i+'" maxlength="1" value="'+question5[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter5[]" id="chkBlankLetter5_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter5_'+i+'"></label></div></div>';
                }
            }
            if(strDivBlankLetter5!='')
            {
                $('#wrapperDivBlankLetter5').show();
                $('#divBlankLetter5').html(strDivBlankLetter5);
            }
        }
        else
        {
            $('#divBlankLetter5').html('');
            $('#err_question5').html('This field is required.');
            $('#wrapperDivBlankLetter5').hide();
            return false;
        }
    });
    $(document).on('blur', '#question6', function(){
        $('#btnGenerate6').trigger('click');
    });
    $(document).on('click', '#btnGenerate6', function(){
        var question6 = $('#question6').val();
        if(question6!='' && question6.length > 0)
        {
            var strDivBlankLetter6 = '';
            for(var i = 0; i < question6.length; i++)
            {
                if(question6[i]!='')
                {
                    strDivBlankLetter6+='<div class="alphabate-letter-section"><input type="text" name="blankLetter6[]" class="form-control blankLetter" id="blankLetter6_'+i+'" maxlength="1" value="'+question6[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter6[]" id="chkBlankLetter6_'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter6_'+i+'"></label></div></div>';
                }
            }
            if(strDivBlankLetter6!='')
            {
                $('#wrapperDivBlankLetter6').show();
                $('#divBlankLetter6').html(strDivBlankLetter6);
            }
        }
        else
        {
            $('#divBlankLetter6').html('');
            $('#err_question6').html('This field is required.');
            $('#wrapperDivBlankLetter6').hide();
            return false;
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==19)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==20)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==21)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==22)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==23)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==24)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==25)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==26)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==27)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==28)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==29)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==30)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==31)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==32)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==33)
{
    $(document).ready(function() {
        $(".digitCommon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(document).on('blur', '.digit1Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });
    $(document).on('blur', '.digit2Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });

    $(document).on('change','.operatorCommon', function(){
        var operatorCommon = $(this).val();
        var tempThis = $(this);
        
        if(operatorCommon!='')
        {
            var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
            var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();
            if((digit1Common!=null && digit1Common!='') && (digit2Common!=null && digit2Common!=''))
            {
                if(operatorCommon == '+')
                {
                    var answerCommon = parseInt(digit1Common) + parseInt(digit2Common);
                }
                else if(operatorCommon == '-')
                {
                    var answerCommon = parseInt(digit1Common) - parseInt(digit2Common);
                }
                else if(operatorCommon == 'x')
                {
                    var answerCommon = parseInt(digit1Common) * parseInt(digit2Common);
                }
                else if(operatorCommon == '/')
                {
                    var answerCommon = parseInt(digit1Common) / parseInt(digit2Common);
                }
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                tempThis.closest('.wrapperDiv').find('.answerCommon').val(answerCommon);
            }
            else
            {
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                if(digit1Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('This field is required');
                }
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                if(digit2Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('This field is required');
                }    
            }
        }
        else
        {
            return false;
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==34)
{
    $(document).ready(function() {
        $(".digitCommon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(document).on('blur', '.digit1Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });
    $(document).on('blur', '.digit2Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });

    $(document).on('change','.operatorCommon', function(){
        var operatorCommon = $(this).val();
        var tempThis = $(this);
        
        if(operatorCommon!='')
        {
            var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
            var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();
            if((digit1Common!=null && digit1Common!='') && (digit2Common!=null && digit2Common!=''))
            {
                if(operatorCommon == '+')
                {
                    var answerCommon = parseInt(digit1Common) + parseInt(digit2Common);
                }
                else if(operatorCommon == '-')
                {
                    var answerCommon = parseInt(digit1Common) - parseInt(digit2Common);
                }
                else if(operatorCommon == 'x')
                {
                    var answerCommon = parseInt(digit1Common) * parseInt(digit2Common);
                }
                else if(operatorCommon == '/')
                {
                    var answerCommon = parseInt(digit1Common) / parseInt(digit2Common);
                }
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                tempThis.closest('.wrapperDiv').find('.answerCommon').val(answerCommon);
            }
            else
            {
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                if(digit1Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('This field is required');
                }
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                if(digit2Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('This field is required');
                }    
            }
        }
        else
        {
            return false;
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==35)
{
    $(document).ready(function() {
        $(".digitCommon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(document).on('blur', '.digit1Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });
    $(document).on('blur', '.digit2Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });

    $(document).on('change','.operatorCommon', function(){
        var operatorCommon = $(this).val();
        var tempThis = $(this);
        /*tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
        tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');*/

        if(operatorCommon!='')
        {
            var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
            var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();
            if((digit1Common!=null && digit1Common!='') && (digit2Common!=null && digit2Common!=''))
            {
                if(operatorCommon == '+')
                {
                    var answerCommon = parseInt(digit1Common) + parseInt(digit2Common);
                }
                else if(operatorCommon == '-')
                {
                    var answerCommon = parseInt(digit1Common) - parseInt(digit2Common);
                }
                else if(operatorCommon == 'x')
                {
                    var answerCommon = parseInt(digit1Common) * parseInt(digit2Common);
                }
                else if(operatorCommon == '/')
                {
                    var answerCommon = parseInt(digit1Common) / parseInt(digit2Common);
                }
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                tempThis.closest('.wrapperDiv').find('.answerCommon').val(answerCommon);
            }
            else
            {
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                if(digit1Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('This field is required');
                }
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                if(digit2Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('This field is required');
                }    
            }
        }
        else
        {
            return false;
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==36)
{
    $(document).ready(function() {
        $(".digitCommon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==37)
{
    $(document).ready(function() {
        $(".digitCommon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(document).on('blur', '.digit1Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });
    $(document).on('blur', '.digit2Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });

    $(document).on('change','.operatorCommon', function(){
        var operatorCommon = $(this).val();
        var tempThis = $(this);
        
        if(operatorCommon!='')
        {
            var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
            var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();
            if((digit1Common!=null && digit1Common!='') && (digit2Common!=null && digit2Common!=''))
            {
                if(operatorCommon == '+')
                {
                    var answerCommon = parseInt(digit1Common) + parseInt(digit2Common);
                }
                else if(operatorCommon == '-')
                {
                    var answerCommon = parseInt(digit1Common) - parseInt(digit2Common);
                }
                else if(operatorCommon == 'x')
                {
                    var answerCommon = parseInt(digit1Common) * parseInt(digit2Common);
                }
                else if(operatorCommon == '/')
                {
                    var answerCommon = parseInt(digit1Common) / parseInt(digit2Common);
                }
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                tempThis.closest('.wrapperDiv').find('.answerCommon').val(answerCommon);
            }
            else
            {
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                if(digit1Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('This field is required');
                }
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                if(digit2Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('This field is required');
                }    
            }
        }
        else
        {
            return false;
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==38)
{
    $(document).ready(function() {
        $(".digitCommon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        $('.dwCommon').selectpicker();
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==39)
{
    $(document).ready(function() {
        $(".digitCommon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(document).on('blur', '.digit1Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });
    $(document).on('blur', '.digit2Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });

    $(document).on('change','.operatorCommon', function(){
        var operatorCommon = $(this).val();
        var tempThis = $(this);
        
        if(operatorCommon!='')
        {
            var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
            var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();
            if((digit1Common!=null && digit1Common!='') && (digit2Common!=null && digit2Common!=''))
            {
                if(operatorCommon == '+')
                {
                    var answerCommon = parseInt(digit1Common) + parseInt(digit2Common);
                }
                else if(operatorCommon == '-')
                {
                    var answerCommon = parseInt(digit1Common) - parseInt(digit2Common);
                }
                else if(operatorCommon == 'x')
                {
                    var answerCommon = parseInt(digit1Common) * parseInt(digit2Common);
                }
                else if(operatorCommon == '/')
                {
                    var answerCommon = parseInt(digit1Common) / parseInt(digit2Common);
                }
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                tempThis.closest('.wrapperDiv').find('.answerCommon').val(answerCommon);
            }
            else
            {
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                if(digit1Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('This field is required');
                }
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                if(digit2Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('This field is required');
                }    
            }
        }
        else
        {
            return false;
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==42)
{
    $(document).ready(function() {
        $(".digitCommon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==43)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==44)
{
    $(document).ready(function() {
        $(".digitCommon").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(document).on('blur', '.digit1Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });
    $(document).on('blur', '.digit2Common', function(){
        $(this).closest('.wrapperDiv').find('.operatorCommon').trigger('change');
    });

    $(document).on('change','.operatorCommon', function(){
        var operatorCommon = $(this).val();
        var tempThis = $(this);
        
        if(operatorCommon!='')
        {
            var digit1Common = $(this).closest('.wrapperDiv').find('.digit1Common').val();
            var digit2Common = $(this).closest('.wrapperDiv').find('.digit2Common').val();
            if((digit1Common!=null && digit1Common!='') && (digit2Common!=null && digit2Common!=''))
            {
                if(operatorCommon == '+')
                {
                    var answerCommon = parseInt(digit1Common) + parseInt(digit2Common);
                }
                else if(operatorCommon == '-')
                {
                    var answerCommon = parseInt(digit1Common) - parseInt(digit2Common);
                }
                else if(operatorCommon == 'x')
                {
                    var answerCommon = parseInt(digit1Common) * parseInt(digit2Common);
                }
                else if(operatorCommon == '/')
                {
                    var answerCommon = parseInt(digit1Common) / parseInt(digit2Common);
                }
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                tempThis.closest('.wrapperDiv').find('.answerCommon').val(answerCommon);
            }
            else
            {
                tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('');
                if(digit1Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit1Common').html('This field is required');
                }
                tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('');
                if(digit2Common=='')
                {
                    tempThis.closest('.wrapperDiv').find('.err_digit2Common').html('This field is required');
                }    
            }
        }
        else
        {
            return false;
        }
    });
    $(document).on('click','.generate',function(){
        var row     = $('#row').val();
        var column  = $('#column').val();
        var i;
        var j;
        var strRow='';
        var strColumn='';
        var strResult = '';
        var flag = 1;
        $('#err_row').html('')
        $('#err_column').html('');

        if(parseInt(row) >= parseInt(column))
        {
            swal('Table From field must be less than Table To.');
            return false;
        }
        else
        {
            var diff = parseInt(column) - parseInt(row);
            if(parseInt(diff)!=9)
            {
                swal('Difference should be 10.');
                return false;
            }
        }

        if(row=='')
        {
            $('#err_row').html('This field is required');
            flag = 0;
        }
        if(column=='')
        {
            $('#err_column').html('This field is required');
            flag = 0;
        }
        if((parseInt(column)-parseInt(row))>10)
        {
            $('#err_row').html('Can\'t generate more than 10 tables');
            flag = 0;
        }
        if(flag==1)
        {
            for(i=1;i<=10;i++){
            strRow+='<div class="cal-default color-bg-col">'+i+'</div>';
            }
            strColumn='<div class="cal-default color-bg-col">X</div>';
            for(j=0;j<=(column-row);j++){
                strColumn+='<div class="cal-default color-bg-col">'+(parseInt(row)+j)+'</div>';
            }
            for(i=1;i<=10;i++){
                for(m=parseInt(row);m<=parseInt(column);m++){
                    strResult+='<div class="cal-default">'+m*i+'</div>';
                }
            }
            $('.column').html(strRow);
            $('.rows').html(strColumn);
            $('.result').html(strResult);
            $('.wrapperDiv1').show();
            $('.wrapperDiv1').find('.digitCommon').val('');
        }
        
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==46)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==47)
{
  $(document).ready(function() {
      $(".digitCommon").keydown(function (e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
               // Allow: Ctrl+A, Command+A
              (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
               // Allow: home, end, left, right, down, up
              (e.keyCode >= 35 && e.keyCode <= 40)) {
                   // let it happen, don't do anything
                   return;
          }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
      });
  });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==48)
{
    $(document).on('keydown', '.classWord', function(e){
      var keyVal = (e.which) ? e.which : e.keyVal;
      if(parseInt(keyVal) != 32)
      {
         return;
      }
      else
      {
         e.preventDefault();
      }
    });
    $(document).on('blur', '#question', function(){
        $('#btnGenerate').trigger('click');
    });
    $(document).on('click', '#btnGenerate', function(){
        var question = $('#question').val();
        if(question!='' && question.length > 0)
        {
            var strDivBlankLetter = '';
            for(var i = 0; i < question.length; i++)
            {
                if(question[i]!='')
                {
                    strDivBlankLetter+='<div class="alphabate-letter-section"><input type="text" name="blankLetter[]" class="form-control blankLetter" id="blankLetter'+i+'" maxlength="1" value="'+question[i]+'" readonly /><div class="check-block"><input name="chkBlankLetter[]" id="chkBlankLetter'+i+'" class="filled-in" type="checkbox" value="'+i+'"><label for="chkBlankLetter'+i+'"></label></div></div>';
                }
            }
            if(strDivBlankLetter!='')
            {
                $('#wrapperDivBlankLetter').show();
                $('#divBlankLetter').html(strDivBlankLetter);

            }
        }
        else
        {
            $('#divBlankLetter').html('');
            $('#err_question').html('This field is required.');
            $('#wrapperDivBlankLetter').hide();
            return false;
        }
    });
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==49)
{
    
}
else if($('#hiddenTemplate').val()!='' && parseInt($('#hiddenTemplate').val())==50)
{
    
}
