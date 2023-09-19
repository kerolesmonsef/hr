   <!-- Add New Modal -->
   <div class="modal fade customeModal" id="addNew" tabindex="-1" aria-labelledby="addNewLabel"
   aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-body">
               <form class="formS1" method="post" action="{{ route('PerformanceFactor.store') }}">
                   @csrf
                   @method('post')
                   <div class="sectionS2">
                       <div class="head withBorder flex align between">
                           <h3 class='small'>@lang('add PerformanceFactors')</h3>
                           <button type="button" class="btn-close" data-bs-dismiss="modal"
                               aria-label="Close"></button>
                       </div>
                       <div class="content">
                           <div class="">
                               <label for="PerformanceFactors-en" class="form-label">@lang('PerformanceFactors name')</label>
                               <div class="inputS1">
                                   <input {{ old('name') }} name="name" type="text"
                                       id="PerformanceFactors-en" placeholder='@lang('PerformanceFactors name')'>
                               </div>
                           </div>

                           <div class="">
                               <label for="PerformanceFactors-ar" class="form-label">@lang('PerformanceFactors name_ar')</label>
                               <div class="inputS1">
                                   <input {{ old('name_ar') }} name="name_ar" type="text"
                                       id="PerformanceFactors-ar" placeholder='@lang('PerformanceFactors name_ar')'>
                               </div>
                           </div>


                           <div class="">
                               <label for="Period" class="form-label">@lang('Performance Period')</label>
                               <div class="inputS1">
                                   <select name="performance_period_id">
                                       @foreach ($performanceperiods as $performanceperiod)
                                           <option value="{{ $performanceperiod->id }}">
                                               {{ $performanceperiod['name'.$lang] }}</option>
                                       @endforeach
                                   </select>
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