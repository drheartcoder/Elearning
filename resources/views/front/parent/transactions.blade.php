@include('front.layout.bredcrum')

<div class="gray-btn-main-section my-student-middle-section">
    <div class="container">            
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                
                @include('front.layout.left_bar')
            </div>           
            
            <div class="col-sm-8 col-md-9 col-lg-9">
                
                @include('front.layout._operation_status')                
                <div class="class-name-head-section">                    
                </div> 
                <div class="row">
                    <form id="frmSearchClass" name="frmSearchClass" method="get">
                        <div style="text-align: left;">
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">                    
                                    <input type="text" id="keyword" name="keyword" placeholder="{{trans('parent.Search_Keyword')}}" tabindex="1" value="{{ Request::get('keyword')!=null && Request::get('keyword')!='' ? Request::get('keyword') : '' }}" />
                                    <div class="error" id="err_keyword">{{$errors->first('keyword')}}</div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-8">
                                <button class="full-orng-btn btn-width-adjustment sim-button" style="margin: 0px 0 25px;"><i class="fa fa-search"></i></button>
                                <a href="{{url('/parent/transactions')}}"  class="full-orng-btn btn-width-adjustment sim-button" style="margin: 0px 0 25px;"><i class="fa fa-retweet"></i></a>
                            </div>
                        </div>
                    </form>
                </div>   
                <div class="clearfix"></div>               
                <div class="table-responsive table-scroll-section">
                    <table class="table students-list-section">                            
                            <tr>
                                <th>{{trans('parent.Transaction_Id')}}</th>
                                <th>{{trans('parent.Plan_Name')}}</th>
                                <th>{{trans('parent.Amount')}}</th>
                               {{--  <th>{{trans('parent.Child_Limit')}}</th> --}}
                                <th>{{trans('parent.Status')}}</th>
                               
                                <th>{{trans('parent.Payment_Status')}}</th>
                                 <th>{{trans('parent.Payment_via')}}</th>
                                <th>{{trans('parent.Expiry_Date')}}</th>
                                <th style="text-align: center;">{{trans('parent.Action')}}</th>
                            </tr>

                            @if(isset($transactions_arr['data']) && !empty($transactions_arr['data']))
                                @foreach($transactions_arr['data'] as $row)
                              
                                    <tr>
                                        <td>{{ $row['transaction_id'] or '' }}</td>
                                        <td>{{ ucfirst($row['plan_data']['name']) or '' }}</td>
                                        <td>{{ $row['amount'].' &#165;' }}</td>
                                       {{--  <td>{{ $row['child_limit'] or '' }}</td> --}}

                                        @if(isset($row['payment_via']) && $row['payment_via']=='offline')
                                            @if(isset($row['payment_status']) && $row['payment_status']=='unpaid')
                                             <td>{{ 'Waiting For Admin Approval'}}</td>
                                            @else
                                             <td>{{ trans('parent.'.ucfirst($row['status'])) }}</td>
                                            @endif
                                        @else
                                             <td>{{ trans('parent.'.ucfirst($row['status'])) }}</td>
                                        @endif
                                        <td>
                                            {{ isset($row['payment_status']) && $row['payment_status']!='' ? trans('parent.'.ucfirst($row['payment_status'])) : '-'}}
                                        </td>

                                        <td>
                                            {{ isset($row['payment_via']) && $row['payment_via']!='' ? trans('parent.'.$row['payment_via']) : '-'}}
                                        </td>

                                        <td>
                                        @if(isset($row['expiry_date']) && $row['expiry_date']!='0000-00-00')
                                        {{ date('d-M-Y',strtotime($row['expiry_date'])) }}
                                        @else
                                        {{ '--' }}
                                        @endif
                                        </td>
                                        @if(isset($row['invoice']) && $row['invoice']!="")
                                        <td><a target="_blank" class="pdf-icon" href="{{ $invoice_path.$row['invoice'] }}"><i class="fa fa-file-pdf-o"></i></a></td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                            <tr><td colspan="5" style="text-align: center;">{{trans('parent.No_Record_Found')}}</td></tr>
                            @endif

                    </table>
                </div>
                <div class="pagination-section-block">
                    <ul>{!! $pagination_link_arr !!}</ul>
                </div>
            </div>
        </div>                                   
    </div>
</div>