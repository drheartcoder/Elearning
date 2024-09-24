@include('front.layout.bredcrum')
    <div class="gray-btn-main-section my-student-middle-section print-report-main">
        <div class="container">            
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-3">
                    @include('front.layout.left_bar')
                </div>
                <div class="col-sm-8 col-md-9 col-lg-9">
                    @include('front.layout._operation_status')
                    @if(Session::has('file'))                                                        
                    <script type="text/javascript">
                        $(document).ready(function(){
                            window.open('{{Session::get("file")}}', '_blank');                                   
                        });
                    </script>
                    @endif
                    <!-- <form action="{{url('/parent/print-class-report')}}" method="post">
                        {{csrf_field()}}
                        <div class="class-name-head-section">
                            Print Class Reports
                        </div>
                        <input type="hidden" name="classid" id="class_id" value="{{Request::segment(3)}}">
                        <div class="form-group">                                
                            <div class="check-block">
                                <input id="filled-in-box" class="filled-in" type="checkbox">
                                <label for="filled-in-box">Student Reports</label>
                            </div>
                        </div>
                        <div class="cancel-print-buttons">
                            <a class="full-fill-button border-button sim-button-blue" data-dismiss="modal">Cancel</a>
                            <button type="submit" class="full-fill-button sim-button">Print</button>
                        </div>
                    </form> -->
                    <form action="" method="post">
                        {{csrf_field()}}                        
                        <div class="print-student-pins-main">
                            <div class="class-name-head-section">
                                {{trans('parent.Print_Student_PINs')}}
                            </div>                        
                            <div class="cancel-print-buttons">
                                <!-- <a class="full-fill-button border-button sim-button-blue" data-dismiss="modal">Cancel</a> -->
                                <button type="submit" id="btnPrintPin" name="btnPrintPin" class="full-fill-button sim-button">{{trans('parent.Print')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>                                   
        </div>
    </div>