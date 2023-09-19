<div class="modal modalS1 fade" id="exampleModal-{{ $offer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $offer->title }}</h1>
                <div class="actions">
                    <button>
                        <img src="/new-theme/icons/undo.svg" alt=""/>
                    </button>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <img src="/new-theme/icons/close.svg" alt=""/>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="sectionMD1">
                    <h3>Job Details</h3>
                    <div class="cards">
                        <div class="card">
                            <div class="name">Job Title</div>
                            <div class="des">{{ $offer->title }}</div>
                        </div>
                        <div class="card">
                            <div class="name">Job Type</div>
                            <div class="type">{{ $offer->job_type }}</div>
                        </div>
                        <div class="card">
                            <div class="name">Publish Date</div>
                            <div class="des">{{ (new \Carbon\Carbon($offer->start_date))->format("d/m/Y") }}</div>
                        </div>
                        <div class="card">
                            <div class="name">Applications Number</div>
                            <div class="des bold">{{ $offer->users_count }} Applicants for ({{ $offer->positions_count }} open position)</div>
                        </div>
                        <div class="card">
                            <div class="name">View Number</div>
                            <div class="des bold">{{ $offer->seen_users_count }}</div>
                        </div>
                    </div>
                </div>
                <div class="sectionMD1">
                    <h3>Job information</h3>
                    <div class="cards">
                        <div class="card">
                            <div class="name">Experience Needed</div>
                            <div class="des">{{ $offer->experience }}</div>
                        </div>
                        <div class="card">
                            <div class="name">Education Level</div>
                            <div class="des">{{ $offer->education_level }}</div>
                        </div>
                        <div class="card">
                            <div class="name">Salary</div>
                            <div class="des">{{ $offer->salary }}</div>
                        </div>
                        <div class="card">
                            <div class="name">Career Level</div>
                            <div class="des">{{ $offer->career_level }}</div>
                        </div>
                        <div class="card">
                            <div class="name">Job Description</div>
                            <div class="des">{!! $offer->job_description !!}</div>
                        </div>
                        
                        <div class="card">
                            <div class="name">Job Requirement</div>
                            <div class="des">{!! $offer->job_requirement !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="location.href='{{ route('job-offer.guest.show',$offer->form_link) }}'" type="button">Apply For Job</button>
            </div>
        </div>
    </div>
</div>