   <!-- Add New Modal -->
   <div class="modal fade customeModal" id="addNew" tabindex="-1" aria-labelledby="addNewLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-body">
                   <form class="formS1" method="post" action="{{ route('PerformancePeriod.store') }}">
                       @csrf
                       @method('post')
                       <div class="sectionS2">
                           <div class="head withBorder flex align between">
                               <h3 class='small'>@lang('add Performanceperiods')</h3>
                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                   aria-label="Close"></button>
                           </div>
                           <div class="content">
                               <div class="">
                                   <label for="performanceperiods-en" class="form-label">@lang('performanceperiods name')</label>
                                   <div class="inputS1">
                                       <input {{ old('name') }} name="name" type="text"
                                           id="performanceperiods-en" placeholder='@lang('performanceperiods name')'>
                                   </div>
                               </div>

                               <div class="">
                                   <label for="performanceperiods-ar" class="form-label">@lang('performanceperiods name_ar')</label>
                                   <div class="inputS1">
                                       <input {{ old('name_ar') }} name="name_ar" type="text"
                                           id="performanceperiods-ar" placeholder='@lang('performanceperiods name_ar')'>
                                   </div>
                               </div>
                               <div class="">
                                   <label for="months_no" class="form-label">@lang('months_no')</label>
                                   <div class="inputS1">
                                       <input {{ old('months_no') }} name="months_no" type="text" id="months_no"
                                           placeholder='@lang('months_no')'>
                                   </div>
                               </div>


                               <div class="flex align end gap-15 orders  mt-5 mb-4">
                                   <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                       aria-label="Close">
                                       @lang('Cancel')
                                   </button>
                                   <button class="buttonS1 primary" type="submit">
                                       @lang('Save')
                                   </button>
                               </div>



                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
