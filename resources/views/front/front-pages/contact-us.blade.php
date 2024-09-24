
<div class="map-cont">
    <div class="featuresInfo">
        <div class="map-setion">
            <div class="loc-map">
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3057.96966265097!2d116.30813031545854!3d39.96443097942023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s902+Room+BIT+Building+Haidian+District%2C+Beijing+City%2C+China+100081!5e0!3m2!1sen!2sin!4v1531725138314" allowfullscreen></iframe> -->
                @php
                    $banner_image='';
                    $banner_image = $contact_us_banner_image_public_img_path.'/no-image-available.png';
                    if(isset($arr_page['banner_image']) && file_exists($contact_us_banner_image_base_img_path.'/'.$arr_page['banner_image'])==true)
                    {
                        $banner_image = $contact_us_banner_image_public_img_path.'/'.$arr_page['banner_image'];
                    }
                @endphp
                <div class="map"><img src="{{$banner_image}}" style="width: 100%; height: 500px;"></div>
                <!-- <div class="map" id="map" style="width: 100%; height: 500px;"></div> -->
            </div>
        </div>
    </div>
</div>

<div class="main-contact-box">
    <div class="container">
        <div class="row">
            <div class="con-main-bx">
                <form method="post" id="form_contact_us" action="{{ url('/contact-us/store') }}">
                    {{ csrf_field() }}

                    <div class="col-sm-6 col-md-6 col-lg-7 white-side">
                        <div class="contact-us-frm">
                            <div class="send-mess-head">
                                {{trans('home.Send_us_a_Message')}}
                            </div>
                            <div class="send-msg-img"> <img src="{{ url('/') }}/images/msg-img.png" alt="msg" /> </div>

                            @include('front.layout._operation_status')

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('auth.First_Name')}}<i class="red">*</i></label>
                                        <input type="text" class="alphabets" id="first_name" name="first_name" placeholder="{{trans('auth.Enter_your_first_name')}}" maxlength="50" value="{{ old('first_name')}}" />
                                        <div class="error" id="err_first_name">{{ $errors->first('first_name') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('auth.Last_Name')}}<i class="red">*</i></label>
                                        <input type="text" class="alphabets" id="last_name" name="last_name" placeholder="{{trans('auth.Enter_your_last_name')}}" maxlength="50" value="{{ old('last_name')}}" />
                                        <div class="error" id="err_last_name">{{ $errors->first('last_name') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">    
                                    @php
                                        $arr_phone_code = [];
                                        $arr_phone_code = get_country_phone_code();
                                    @endphp
                                    @if(isset($arr_phone_code) && sizeof($arr_phone_code)>0)
                                     <div class="form-group">
                                        <label>{{trans('auth.PhoneCode')}}<i class="red">*</i></label>
                                        <select id="phone_code" name="phone_code">
                                            <option value="">{{trans('auth.Select_PhoneCode')}}</option>
                                            @foreach($arr_phone_code as $phone_code)
                                             @if(isset($phone_code['nicename']) && $phone_code['nicename']!="")
                                                  <option value="{{ $phone_code['id'] }}">
                                                      
                                                      ({{ $phone_code['nicename'] }}) +{{ $phone_code['phonecode'] }}
                                                  </option>
                                             @endif
                                            @endforeach
                                        </select>
                                         <div class="error" id="err_phone_code">{{ $errors->first('phone_code') }}</div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{trans('home.Contact_Number')}}<i class="red">*</i></label>
                                        <input type="text" class="digits" id="contact_mobile" name="mobile" placeholder="{{trans('auth.Enter_your_contact_number')}}" minlength="6" maxlength="16" value="{{ old('mobile')}}" />
                                        <div class="error" id="err_mobile">{{ $errors->first('mobile') }}</div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>{{trans('auth.Email')}}<i class="red">*</i></label>
                                        <input type="text" name="email" id="contact_email" maxlength="60" placeholder="{{trans('auth.Enter_your_email')}}" value="{{ old('email')}}"/>
                                        <div class="error" id="err_email">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>{{trans('parent.Subject')}}<i class="red">*</i></label>
                                        <input type="text" name="subject" id="subject" maxlength="100" placeholder="{{trans('home.Enter_your_Subject')}}" value="{{ old('subject') }}"/>
                                        <div class="error" id="err_subject">{{ $errors->first('subject') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>{{trans('home.Message')}}<i class="red">*</i></label>
                                        <textarea id="message" name="message" maxlength="1000" placeholder="{{trans('home.Write_a_Message')}}">{{ old('message') }}</textarea>
                                        <div class="error" id="err_message">{{ $errors->first('message') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="send-msg-mess-btn">
                                        <button type="submit" id="btn_submit_contact_us" class="full-orng-btn sim-button">{{trans('home.Send')}}</button>
                                    </div>
                                </div>
                                <div class="clr"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>

                <div class="col-sm-6 col-md-6 col-lg-5 blue-side">
                    <div class="contact-info-block">
                        <div class="overlay-blue"></div>
                        <div class="info-main">
                            
                            <div class="contact-info-head">
                                {{trans('home.Contact_Information')}} 
                            </div>
                            
                            <div class="info-block-container">
                                <span class="img-contact-block email-id-section"><img src="{{ url('/') }}/images/contact-message-img.png" alt="" /></span>
                                <span>{{ isset($arr_site_setting['site_email_address']) && !empty($arr_site_setting['site_email_address']) ? $arr_site_setting['site_email_address'] : '' }}</span>
                            </div>
                            <div class="info-block-container">
                                <span class="call-img-block"><img src="{{ url('/') }}/images/contact-call-img.png" alt="" /></span>
                                <span>{{ isset($arr_site_setting['site_contact_number']) && !empty($arr_site_setting['site_contact_number']) ? $arr_site_setting['site_contact_number'] : '' }}</span>
                            </div>

                            @if(isset($arr_address) && !empty($arr_address))
                            <div class="contact-address-info-main">
                                @foreach($arr_address as $key => $address)
                       
                                <div class="info-block-container contact-address-section address_list" data-name="{{ $address['address_translation'][0]['address'] or '' }}"  style="cursor: pointer;">
                                        <span class="img-contact-block"><img src="{{ url('/') }}/images/contact-map-img.png" alt="" /></span>
                                    <span class="contact-address-txt">{{trans('parent.Address') }} {{ $key + 1 }} : {{ $address['address_translation'][0]['address'] or '' }}</span>
                                        <div class="clr"></div>
                                    </div>
                                @endforeach
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        //VanillaRunOnDomReady();
    })
    
    var VanillaRunOnDomReady = function() {
        (function(Mapping, $, undefined) {
            var self = this;

            function Initialize() {
                var myOptions = {
                    zoomControl: true,
                    zoom: 4,
                    center: new google.maps.LatLng(34.724748, 103.703827),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    /*scrollwheel: false,*/
                };

                self.map        = new google.maps.Map(document.getElementById("map"),myOptions);
                self.markers    = [];
                self.infoWindow = new google.maps.InfoWindow();
                self.service    = new google.maps.places.PlacesService(self.map);

                $('.address_list').each(function() {
                    var $this  = $(this);
                    var pos    = new google.maps.LatLng($this.data('lat'), $this.data('lng'));
                    var marker = new google.maps.Marker({
                        position: pos,
                        map: self.map,
                        title: $this.data('name'),
                    });
                    self.markers.push(marker);

                    marker.addListener('click', function() {
                        self.infoWindow.setContent($this.data('name'));
                        self.infoWindow.open(self.map, marker);
                        $this.siblings().removeClass('active');
                        $this.addClass('active');
                    });

                    $this.click(function() {
                        self.map.panTo(pos);
                        self.infoWindow.setContent($this.data('name'));
                        self.infoWindow.open(self.map, marker);
                        $this.siblings().removeClass('active');
                        $this.addClass('active');
                    });
                });
            }

            Initialize();
        })(window.Mapping = window.Mapping || {}, jQuery);
    }

    /*var alreadyrunflag = 0;*/

    if (document.addEventListener)
    document.addEventListener("DOMContentLoaded", function(){
        //alreadyrunflag = 1;
        // /VanillaRunOnDomReady();
    });
    else if (document.all && !window.opera) {
        //document.write('<script id="contentloadtag" defer="defer" src="javascript:void(0)"><\/script>');
        var contentloadtag = document.getElementById("contentloadtag");
        contentloadtag.onreadystatechange = function(){
            if (this.readyState=="complete"){
                /*alreadyrunflag=1;*/
                VanillaRunOnDomReady();
            }
        }
    }
</script>