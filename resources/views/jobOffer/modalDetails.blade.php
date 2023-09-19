<!-- The Modal -->
<div class="modal fade modal-lg" id="myModal" style="">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">{{ __('Applicant details') }}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <label style="font-weight:bold;">{{ __('Name') }}</label>
                <p class="name"></p>
                <label style="font-weight:bold;">{{ __('Email') }}</label>
                <p class="email"></p>
                <label style="font-weight:bold;">{{ __('Phone') }}</label>
                <p class="phone"></p>
                <label style="font-weight:bold;">{{ __('Age') }}</label>
                <p class="age"></p>

                <label style="font-weight:bold;">{{ __('Address') }}</label>
                <p class="address"></p>
                <label style="font-weight:bold;">{{ __('Age') }}</label>
                <p class="education"></p>
                <label style="font-weight:bold;">{{ __('Education') }}</label>
                <p class="experience"></p>



            </div>
            <div class="col-md-6">
                <label style="font-weight:bold;">{{ __('How did you hear about this offer ?') }}</label>
                <p class="findus"></p>
                <label style="font-weight:bold;">{{ __('Interview day') }}</label>
                <p class="interview_day"></p>
                <label style="font-weight:bold;">{{ __('Years of experience') }}</label>
                <p class="linkedin_profile"></p>
                <label style="font-weight:bold;">{{ __('Linkedin profile') }}</label>
                <p class="linkedin_profile"></p>
                <label style="font-weight:bold;">{{ __('Join us date') }}</label>
                <p class="join_us_date"></p>
                <label style="font-weight:bold;">{{ __('Expected salary') }}</label>
                <p class="salary"></p>
                <label style="font-weight:bold;">{{ __('How do you rate yourself in spoken and written English?') }}</label>
                <p class="english_rate"></p>
            </div>
            <div class="col-md-12 " >
                <hr>
                <label style="font-weight:bold;">{{ __('Which position are you interested in ?') }}</label>
                <p class="field"></p>
            </div>
            <div class="col-md-12 message-section" >
                <hr>
                <label style="font-weight:bold;">{{ __('Message') }}</label>
                <p class="message"></p>
            </div>
            <div class="col-md-12 " >
                <hr>
                    <label style="font-weight:bold;display:block;">{{ __('CV') }}</label>
                    <a class="btn btn-secondary download-link"  href="" download>
                        <i class="fa fa-download"></i>
                    </a>
                    <a class="btn btn-secondary download-link"  href="" target="_blank">
                        <i class="fa fa-eye"></i>
                    </a>
            </div>
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('Close') }}</button>
      </div>
    </div>
  </div>
</div>
<!-- The Modal -->
