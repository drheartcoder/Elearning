@include('front.layout.bredcrum')

<div class="gray-btn-main-section my-student-middle-section print-report-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3">
                @include('front.layout.left_bar')
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="class-name-head-section">
                        {{ $pageTitle }}
                    </div>
                    <div class="homework-search">
                        
                        <form method="get" id="form_serach_homework">
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <div class="name-field">
                                            <select name="subject" id="subject">
                                                <option value="">{{trans('parent.Select_Subject')}}</option>
                                                @if( isset($arr_subject) && !empty($arr_subject) )
                                                    @foreach($arr_subject as $subject)
                                                        <option value="{{ $subject['id'] }}" @if($search_subject_id == $subject['id']) selected @endif>{{ $subject['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <div class="name-field">
                                            <select name="grade" id="grade">
                                                <option value="">{{trans('parent.Select_Grade')}}</option>
                                                @if( isset($arr_grade) && !empty($arr_grade) )
                                                    @foreach($arr_grade as $grade)
                                                        <option value="{{ $grade['id'] }}" @if($search_grade_id == $grade['id']) selected @endif>{{ $grade['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="inline-btns">
                                        <button type="submit" id="btn_submit_parent_search_homework" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fa fa-search"></i></button>
                                        <a href="{{ $reset_link }}" class="full-orng-btn btn-width-adjustment sim-button m-0"><i class="fa fa-retweet"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="file-wrapper">
                        <div class="row">
                            
                            @if(isset($arr_textbook['data']) && !empty($arr_textbook['data']))
                                @foreach($arr_textbook['data'] as $key => $textbook)

                                    <?php
                                        if(isset($textbook['file']) && $textbook['file']!='')
                                        {
                                            if(file_exists($textbook_file_base_img_path.$textbook['file']))
                                            {
                                                $fileUrl = $textbook_file_public_img_path.$textbook['file'];
                                                $fileExt = strtolower(pathinfo($textbook['file'], PATHINFO_EXTENSION));

                                                if($fileExt=='png' || $fileExt=='jpg' || $fileExt=='jpeg')
                                                {
                                                    $file_html = '<img src="'.$fileUrl.'" class="img-responsive" />';
                                                }
                                                else if($fileExt=='mp4')
                                                {
                                                    $file_html = '<video id="video1" controls width="190" height="80"><source src="'.$fileUrl.'" type="video/mp4" > Your browser does not support HTML5 video.</video>';
                                                }
                                                else if($fileExt=='pdf' || $fileExt=='txt')
                                                {
                                                    $file_html = '<img src="'.url('/').'/images/pdf-file.png" class="img-responsive"/>';
                                                }
                                                else if($fileExt=='docx' || $fileExt=='xlsx' || $fileExt=='pptx')
                                                {
                                                    $file_html = '<img src="'.url('/').'/images/doc-file.png" class="img-responsive"/>';
                                                }
                                            }
                                        }
                                    ?>

                                    <div class="col-xs-6 col-xs-6 col-sm-4 col-md-3 col-lg-3">
                                        <div class="file-block">
                                            <div class="file-img">{!! $file_html !!}</div>
                                            <a href="{{ $fileUrl }}" class="full-fill-button border-button sim-button-blue" data-dismiss="modal" download>{{trans('parent.Download')}}</a>
                                        </div>
                                    </div>

                                @endforeach
                            @else
                                <div style="text-align: center;">{{trans('parent.No_textbook_available')}}</div>
                            @endif

                        </div>
                    </div>

                    <div class="pagination-section-block">
                        <ul>{!! $arr_pagination !!}</ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>