@if (request()->routeIs('recruiter.post-job'))
    <form class="job-form" action="{{ route('recruiter.store.post-jobs') }}" method="POST">
        @csrf
        <div class="field-grid">
            <label class="field">
                <span class="field-label">Job Title</span>
                <input type="text" placeholder="e.g. Senior Laravel Engineer" aria-label="Job Title" name="job_title"
                    value="{{ old('job_title') }}">
                @error('job_title')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
            <label class="field">
                <span class="field-label">Company</span>
                <input type="text" placeholder="Company Name" aria-label="Company" name="company_name"
                    value="{{ old('company_name') }}">
                @error('company_name')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        <div class="field-grid">
            <label class="field">
                <span class="field-label">Location</span>
                <input type="text" placeholder="Remote or City, Country" aria-label="Location" name="location"
                    value="{{ old('location') }}">
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
            <label class="field">
                <span class="field-label">Work Type</span>
                <select aria-label="Work Type" name="work_type">
                    <option value="Remote" {{ old('work_type') == 'Remote' ? 'selected' : '' }}>
                        Remote</option>
                    <option value="Hybrid" {{ old('work_type') == 'Hybrid' ? 'selected' : '' }}>
                        Hybrid</option>
                    <option value="On-site" {{ old('work_type') == 'On-site' ? 'selected' : '' }}>
                        On-site</option>
                </select>
                @error('work_type')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        <div class="field-grid">
            <label class="field">
                <span class="field-label">Employment Type</span>
                <select aria-label="Employment Type" name="employment_type">
                    <option value="Full-time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time
                    </option>
                    <option value="Part-time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time
                    </option>
                    <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract
                    </option>
                    <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>
                        Internship
                    </option>
                </select>
                @error('employment_type')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
            <label class="field">
                <span class="field-label">Experience Level</span>
                <select aria-label="Experience Level" name="experience_level">
                    <option value="Junior" {{ old('experience_level') == 'Junior' ? 'selected' : '' }}>Junior</option>
                    <option value="Mid" {{ old('experience_level') == 'Mid' ? 'selected' : '' }}>Mid</option>
                    <option value="Senior" {{ old('experience_level') == 'Senior' ? 'selected' : '' }}>Senior</option>
                    <option value="Lead" {{ old('experience_level') == 'Lead' ? 'selected' : '' }}>Lead</option>
                </select>
                @error('experience_level')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        <div class="field-grid">
            <label class="field">
                <span class="field-label">Salary Range</span>
                <div class="inline-fields">
                    <input type="number" placeholder="Min" aria-label="Salary minimum" name="min_salary"
                        value="{{ old('min_salary') }}">
                    <input type="number" placeholder="Max" aria-label="Salary maximum" name="max_salary"
                        value="{{ old('max_salary') }}">
                    <select aria-label="Currency" name="currency">
                        <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>
                            USD</option>
                        <option value="INR" {{ old('currency') == 'INR' ? 'selected' : '' }}>
                            INR</option>
                        <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>
                            EUR</option>
                    </select>
                    @error('min_salary')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                    @error('max_salary')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                    @error('currency')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
            </label>
            <label class="field">
                <span class="field-label">Hiring Urgency</span>
                <select aria-label="Hiring urgency" name="hiring_urgency">
                    <option value="Normal" {{ old('hiring_urgency') == 'Normal' ? 'selected' : '' }}>Normal</option>
                    <option value="High" {{ old('hiring_urgency') == 'High' ? 'selected' : '' }}>High</option>
                    <option value="Immediate" {{ old('hiring_urgency') == 'Immediate' ? 'selected' : '' }}>Immediate
                    </option>
                </select>
                @error('hiring_urgency')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        <label class="field">
            <span class="field-label">Job Description</span>
            <textarea rows="5" placeholder="Describe responsibilities, impact, and expectations" aria-label="Job description"
                name="job_description">{{ old('job_description') }}</textarea>
            @error('job_description')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </label>

        <label class="field">
            <span class="field-label">Required Skills</span>
            <textarea rows="4" placeholder="Example: 5+ years with Laravel, REST APIs, MySQL, Vue/React"
                aria-label="Required skills" name="required_skills">{{ old('required_skills') }}</textarea>
            @error('required_skills')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </label>

        <label class="field">
            <span class="field-label">Nice-to-haves</span>
            <textarea rows="3" placeholder="Example: AWS, Terraform, event-driven systems" aria-label="Nice to haves"></textarea>
        </label>

        <div class="field-grid">
            <label class="field">
                <span class="field-label">Application Email / URL</span>
                <input type="text" placeholder="careers@company.com or https://..."
                    aria-label="Application email or link" name="application_link"
                    value="{{ old('application_link') }}">
                @error('application_link')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
            <label class="field">
                <span class="field-label">Close Applications On</span>
                <input type="date" aria-label="Close date" name="closing_date" value="{{ old('closing_date') }}"
                    min="{{ date('Y-m-d') }}">
                @error('closing_date')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        @include('recruiter.partials.draft-publish-actions', [
            'draftButtonLabel' => 'Save Draft',
            'publishButtonLabel' => 'Publish Job',
        ])
    </form>
@elseif(request()->routeIs('recruiter.edit-job') && !empty($draftJobCard))
    <form class="job-form" action="{{ route('recruiter.update.post-jobs', $draftJobCard->slug) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="field-grid">
            <label class="field">
                <span class="field-label">Job Title</span>
                <input type="text" placeholder="e.g. Senior Laravel Engineer" aria-label="Job Title"
                    name="job_title" value="{{ $draftJobCard->job_title ?? old('job_title') }}">
                @error('job_title')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
            <label class="field">
                <span class="field-label">Company</span>
                <input type="text" placeholder="Company Name" aria-label="Company" name="company_name"
                    value="{{ $draftJobCard->company_name ?? old('company_name') }}">
                @error('company_name')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        <div class="field-grid">
            <label class="field">
                <span class="field-label">Location</span>
                <input type="text" placeholder="Remote or City, Country" aria-label="Location" name="location"
                    value="{{ $draftJobCard->location ?? old('location') }}">
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
            <label class="field">
                <span class="field-label">Work Type</span>
                <select aria-label="Work Type" name="work_type">
                    <option value="Remote"
                        {{ ($draftJobCard->work_type == 'Remote' ? 'selected' : old('work_type') == 'Remote') ? 'selected' : '' }}>
                        Remote</option>
                    <option value="Hybrid"
                        {{ ($draftJobCard->work_type == 'Hybrid' ? 'selected' : old('work_type') == 'Hybrid') ? 'selected' : '' }}>
                        Hybrid</option>
                    <option value="On-site"
                        {{ ($draftJobCard->work_type == 'On-site' ? 'selected' : old('work_type') == 'On-site') ? 'selected' : '' }}>
                        On-site</option>
                </select>
                @error('work_type')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        <div class="field-grid">
            <label class="field">
                <span class="field-label">Employment Type</span>
                <select aria-label="Employment Type" name="employment_type">
                    <option value="Full-time"
                        {{ ($draftJobCard->employment_type == 'Full-time' ? 'selected' : old('employment_type') == 'Full-time') ? 'selected' : '' }}>
                        Full-time
                    </option>
                    <option value="Part-time"
                        {{ ($draftJobCard->employment_type == 'Part-time' ? 'selected' : old('employment_type') == 'Part-time') ? 'selected' : '' }}>
                        Part-time
                    </option>
                    <option value="Contract"
                        {{ ($draftJobCard->employment_type == 'Contract' ? 'selected' : old('employment_type') == 'Contract') ? 'selected' : '' }}>
                        Contract
                    </option>
                    <option value="Internship"
                        {{ ($draftJobCard->employment_type == 'Internship' ? 'selected' : old('employment_type') == 'Internship') ? 'selected' : '' }}>
                        Internship
                    </option>
                </select>
                @error('employment_type')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
            <label class="field">
                <span class="field-label">Experience Level</span>
                <select aria-label="Experience Level" name="experience_level">
                    <option value="Junior"
                        {{ ($draftJobCard->experience_level == 'Junior' ? 'selected' : old('experience_level') == 'Junior') ? 'selected' : '' }}>
                        Junior</option>
                    <option value="Mid"
                        {{ ($draftJobCard->experience_level == 'Mid' ? 'selected' : old('experience_level') == 'Mid') ? 'selected' : '' }}>
                        Mid</option>
                    <option value="Senior"
                        {{ ($draftJobCard->experience_level == 'Senior' ? 'selected' : old('experience_level') == 'Senior') ? 'selected' : '' }}>
                        Senior</option>
                    <option value="Lead"
                        {{ ($draftJobCard->experience_level == 'Lead' ? 'selected' : old('experience_level') == 'Lead') ? 'selected' : '' }}>
                        Lead</option>
                </select>
                @error('experience_level')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        <div class="field-grid">
            <label class="field">
                <span class="field-label">Salary Range</span>
                <div class="inline-fields">
                    <input type="number" placeholder="Min" aria-label="Salary minimum" name="min_salary"
                        value="{{ $draftJobCard->min_salary ?? old('min_salary') }}">
                    <input type="number" placeholder="Max" aria-label="Salary maximum" name="max_salary"
                        value="{{ $draftJobCard->max_salary ?? old('max_salary') }}">
                    <select aria-label="Currency" name="currency">
                        <option value="USD"
                            {{ ($draftJobCard->currency == 'USD' ? 'selected' : old('currency') == 'USD') ? 'selected' : '' }}>
                            USD</option>
                        <option value="INR"
                            {{ ($draftJobCard->currency == 'INR' ? 'selected' : old('currency') == 'INR') ? 'selected' : '' }}>
                            INR</option>
                        <option value="EUR"
                            {{ ($draftJobCard->currency == 'EUR' ? 'selected' : old('currency') == 'EUR') ? 'selected' : '' }}>
                            EUR</option>
                    </select>
                    @error('min_salary')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                    @error('max_salary')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                    @error('currency')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
            </label>
            <label class="field">
                <span class="field-label">Hiring Urgency</span>
                <select aria-label="Hiring urgency" name="hiring_urgency">
                    <option value="Normal"
                        {{ ($draftJobCard->hiring_urgency == 'Normal' ? 'selected' : old('hiring_urgency') == 'Normal') ? 'selected' : '' }}>
                        Normal</option>
                    <option value="High"
                        {{ ($draftJobCard->hiring_urgency == 'High' ? 'selected' : old('hiring_urgency') == 'High') ? 'selected' : '' }}>
                        High</option>
                    <option value="Immediate"
                        {{ ($draftJobCard->hiring_urgency == 'Immediate' ? 'selected' : old('hiring_urgency') == 'Immediate') ? 'selected' : '' }}>
                        Immediate
                    </option>
                </select>
                @error('hiring_urgency')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        <label class="field">
            <span class="field-label">Job Description</span>
            <textarea rows="5" placeholder="Describe responsibilities, impact, and expectations"
                aria-label="Job description" name="job_description">{{ $draftJobCard->job_description ?? old('job_description') }}</textarea>
            @error('job_description')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </label>

        <label class="field">
            <span class="field-label">Required Skills</span>
            <textarea rows="4" placeholder="Example: 5+ years with Laravel, REST APIs, MySQL, Vue/React"
                aria-label="Required skills" name="required_skills">{{ json_decode($draftJobCard->required_skills) ?? old('required_skills') }}</textarea>
            @error('required_skills')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </label>

        <label class="field">
            <span class="field-label">Nice-to-haves</span>
            <textarea rows="3" placeholder="Example: AWS, Terraform, event-driven systems" aria-label="Nice to haves">{{ $draftJobCard->nice_to_haves ?? old('nice_to_haves') }}</textarea>
        </label>

        <div class="field-grid">
            <label class="field">
                <span class="field-label">Application Email / URL</span>
                <input type="text" placeholder="careers@company.com or https://..."
                    aria-label="Application email or link" name="application_link"
                    value="{{ $draftJobCard->application_link ?? old('application_link') }}">
                @error('application_link')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
            <label class="field">
                <span class="field-label">Close Applications On</span>
                <input type="date" aria-label="Close date" name="closing_date" value="{{ $draftJobCard->closing_date ?? old('closing_date') }}"
                    min="{{ date('Y-m-d') }}">
                @error('closing_date')
                    <span class="invalid-feedback" role="alert">
                        <small>{{ $message }}</small>
                    </span>
                @enderror
            </label>
        </div>

        @include('recruiter.partials.draft-publish-actions', [
            'draftButtonLabel' => 'Update Draft',
            'publishButtonLabel' => 'Publish Changes',
        ])
    </form>
@endif
