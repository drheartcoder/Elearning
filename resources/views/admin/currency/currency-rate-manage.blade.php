@extends('admin.layout.master')    
@section('main_content')
<style type="text/css">
   .dropdown.bootstrap-select{ width: 100% !important;}
</style>
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->
<!-- Content area -->
<div class="content AddCurrencyRate" style="display: none;">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-money"></i>
                  </div>
                  <h4 class="card-title">Add Currency Rate
                  </h4>
               </div>
               <div class="card-body">                  
                  <form class="form-horizontal" id="frm_create_currency" name="frm_create_currency" action="" method="post">
                     {{csrf_field()}}                     
                        <h4 class="title"></h4>
                        <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">From Currency <i class="red">*</i></label>
                            <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="from_currency" id="from_currency">
                                <option value="">Select From Currency</option>
                                @if(isset($arr_currency) && count($arr_currency)>0)
                                  @foreach($arr_currency as $row) 
                                    <option value="{{$row['id']}}">{{$row['code']}}</option>
                                  @endforeach
                                @endif
                            </select>
                            <span class="error">{{ $errors->first('from_currency') }} </span>
                        </div>
                        <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">To Currency <i class="red">*</i></label>
                            <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="to_currency" id="to_currency">
                                <option value="">Select To Currency</option>
                                @if(isset($arr_currency) && count($arr_currency)>0)
                                  @foreach($arr_currency as $row) 
                                    <option value="{{$row['id']}}">{{$row['code']}}</option>
                                  @endforeach
                                @endif
                            </select>
                            <span class="error">{{ $errors->first('to_currency') }} </span>
                        </div>

                        <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Rate <i class="red">*</i></label>
                            <input type="text" name="rate" id="rate" class="form-control" data-rule-required="true" data-rule-number='true' data-rule-maxlength="60">
                            <div class="clearfix"></div>                            
                            <span class="error">{{ $errors->first('rate') }}</span>
                        </div>                                                              
                     <button type="submit" id="btnAddCurrecnyRate" name="btnAddCurrecnyRate" class="btn btn-rose pull-right">Add</button>
                     <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>            
         </div>         
      </div>      
   </div>   
</div>
<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content EditCurrencyRate" style="display: none;">
   <div class="container-fluid">
      <div class="row">
         <div class="card-body-section">
            <div class="card">
               <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                     <i class="fa fa-money"></i>
                  </div>
                  <h4 class="card-title">Edit Currency Rate
                  </h4>
               </div>
               <div class="card-body">                  
                  <form class="form-horizontal" id="frm_create_currency_edit" name="frm_create_currency" action="" method="post">
                     {{csrf_field()}}                     
                        <h4 class="title"></h4>
                        <input type="hidden" name="rate_id" id="rate_id" value="">
                        <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">From Currency <i class="red">*</i></label>
                            <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="from_currency_edit" id="from_currency_edit">
                                <!-- <option value="">Select From Currency</option> -->
                                @if(isset($arr_currency) && count($arr_currency)>0)
                                  @foreach($arr_currency as $row) 
                                    <option value="{{$row['id']}}">{{$row['code']}}</option>
                                  @endforeach
                                @endif
                            </select>
                            <span class="error">{{ $errors->first('from_currency_edit') }} </span>
                        </div>
                        <div class="form-group has-default bmd-form-group is-filled">
                        <label class="bmd-label-floating">To Currency <i class="red">*</i></label>
                            <select class="selectpicker" data-rule-required="true" data-style="select-with-transition" name="to_currency_edit" id="to_currency_edit">
                                <!-- <option value="">Select To Currency</option> -->
                                @if(isset($arr_currency) && count($arr_currency)>0)
                                  @foreach($arr_currency as $row) 
                                    <option value="{{$row['id']}}">{{$row['code']}}</option>
                                  @endforeach
                                @endif
                            </select>
                            <span class="error">{{ $errors->first('to_currency_edit') }} </span>
                        </div>

                        <div class="form-group has-default bmd-form-group is-filled">
                            <label class="bmd-label-floating">Rate <i class="red">*</i></label>
                            <input type="text" name="rate_edit" id="rate_edit" class="form-control" data-rule-required="true" data-rule-number='true' data-rule-maxlength="60">
                            <div class="clearfix"></div>                            
                            <span class="error">{{ $errors->first('rate_edit') }}</span>
                        </div>                                                              
                     <button type="submit" id="btnEditCurrecnyRate" name="btnEditCurrecnyRate" class="btn btn-rose pull-right">Update</button>
                     <button type="button" onclick="location.href='{{$module_url_path}}'" class="btn btn-rose pull-right">Cancel</button>
                     <div class="clearfix"></div>
                  </form>
               </div>
            </div>            
         </div>         
      </div>      
   </div>   
</div>
<!-- BEGIN Main Content -->


<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                     <!-- <i class="material-icons">assignment</i> -->
                     <i class="{{ $module_icon or ''}}"> </i>
                  </div>
                  <h4 class="card-title">{{ $page_title }}</h4>
               </div>
               <div class="card-body">
                  @include('admin.layout._operation_status')
                  <?php $keyword = Request::input('keyword');  ?>
                  <form name="frm-manage" id="frm-manage" method="get" action="{{$module_url_path.'/rate-manage'}}" class="form-horizontal" >
                     <!-- <h4 class="title"></h4>-->
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group has-default bmd-form-group is-filled">
                              <label class="bmd-label-floating">Keyword </label>
                              <input type="text" name="keyword" id="keyword"  class="form-control" data-rule-required="true" data-rule-maxlength="60" value="{{$keyword or ''}}">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <button type="submit" class="btn btn-rose">search</button>
                           <a href="{{ $module_url_path.'/rate-manage' }}" class="btn btn-default">Clear</a>
                        </div>
                     </div>
                  </form>
                  <div class="clearfix"></div>
                  <form class="form-horizontal" id="frm_manage" name="frm_manage" action="{{$module_url_path}}/multi_action" method="post">
                     {{csrf_field()}}    
                      <div class="toolbar">            
                        <a class="btn btn-link btn-info btn-just-icon like btnAddCurrencyRate" title="Add"><i class="material-icons">add</i></a>                 
                      </div>
                     <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                           <thead>
                              <tr class="border-solid">
                                 <th style="width:18px">
                                    <div class="form-check">
                                       <label class="form-check-label">
                                       <input class="form-check-input" type="checkbox" name="selectall" id="selectall" onchange="chk_all(this);" value="selectall">
                                       <span class="form-check-sign">
                                       <span class="check"></span>
                                       </span>
                                       </label>
                                    </div>
                                 </th>
                                 <th>From Currency</th>
                                 <th>To Currency</th>
                                 <th>Rate</th>
                                 <th>Action</th>
                              </tr>                           
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </form>
               </div>
               {!! $pagination_arr !!}
               <!-- end content-->
            </div>
            <!--  end card  -->
         </div>
         <!-- end col-md-12 -->
      </div>
      <!-- end row -->
   </div>
</div>

<script>

    $(document).ready(function() {
      var keyword   = $('#keyword').val();      
      var module_url_path = "{{ url($module_url_path).'/rate-manage' }}";
      var temp_url        = module_url_path + '/load_data';
      var url             = temp_url.replace(/&amp;/g, '&');

    $('#datatables').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
      },
      "processing" : true,
      "serverSide" : true,
      "paging"     : true,
      "searching"  : false,
      "ordering"   : true,
      "destroy"    : true,
      ajax :
      {
        'url'  : temp_url,
        'data' : { 'keyword':keyword }
      },
      "columnDefs" : [
        { orderable : false, targets: [0,4] }
      ],
      "aaSorting" : []
    });

    var table = $('#datatable').DataTable();

    // Edit record
    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      var data = table.row($tr).data();
      alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
    });

    // Delete a record
    table.on('click', '.remove', function(e) {
      $tr = $(this).closest('tr');
      table.row($tr).remove().draw();
      e.preventDefault();
    });

    //Like record
    table.on('click', '.like', function() {
      alert('You clicked on Like button');
    });
  });


    

    $(".btnAddCurrencyRate").on('click',function(){
      $(".AddCurrencyRate").show();
      $(".EditCurrencyRate").hide();
    });

    $(document).on('click',".btnEditCurrencyRate",function(){
      var id            = $(this).attr('data-rate-id');
      var from_currency = $(this).attr('data-from-currency-id');
      var to_currency   = $(this).attr('data-to-currency-id');
      var rate          = $(this).attr('data-currency-rate');

      $("#rate_id").val(id);
      $("#from_currency_edit").val(from_currency).attr('selected','selected');
      $("#to_currency_edit").val(to_currency).attr('selected','selected');
      $("#rate_edit").val(rate);

      $("#from_currency_edit").selectpicker('refresh');
      $("#to_currency_edit").selectpicker('refresh');

      $('#rate_edit').parent().addClass('is-filled');
      $(".EditCurrencyRate").show();
      $(".AddCurrencyRate").hide();
    });

    var rules = new Object();       
    $(document).ready(function()
    {
      $('#frm_create_currency').validate(
      {
        highlight: function(element) { },
        ignore: [],
        rules: rules
      });

      $('#frm_create_currency_edit').validate(
      {
        highlight: function(element) { },
        ignore: [],
        rules: rules
      });
    });

     // Allow only Numeric Characters
    $('#rate,#rate_edit').keyup(function() {
        if (this.value.match(/[^0-9.]/g)) {
            this.value = this.value.replace(/[^0-9.]/g, '');
        }
    });
</script>  
@endsection