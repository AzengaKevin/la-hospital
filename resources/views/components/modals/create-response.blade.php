@props(['request'])

<div class="modal" tabindex="-1" id="create-reponse-modal">
    <div class="modal-dialog">
        <form x-data="{ responseType: null }" class="modal-content"
            action="{{ route('doctor.requests.responses.store', $request) }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Create Response</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="">
                    <select x-ref="type" name="type" id="type" class="form-select @error('type') is-invalid @enderror"
                        x-on:change="responseType = $refs.type.value">
                        <option value="" selected disabled>Select Response Type...</option>
                        @foreach (\App\Models\Response::types() as $item)
                        <option value="{{ $item }}" {{ old('type') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('type')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <textarea name="description" id="description"
                        class="form-control @error('description') is-invalid @enderror" rows="3"></textarea>
                    @error('description')
                    <span class="invalid-feedback">
                        <strong class="">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <fieldset class="mt-3" x-show=" responseType=='Appointment'">
                    <legend>Appointment</legend>

                    @error('appointment.*')
                    <span class=" invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-end fw-bold" for="address">Address</label>
                        <div class="col-md-8">
                            <input type="text" name="appointment[address]" id="address" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label class="col-md-2 col-form-label text-md-end fw-bold" for="date">Date</label>
                        <div class="col-md-8">
                            <input type="date" name="appointment[date]" id="date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label class="col-md-2 col-form-label text-md-end fw-bold" for="time">Time</label>
                        <div class="col-md-8">
                            <input type="time" name="appointment[time]" id="time" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label class="col-md-2 col-form-label text-md-end fw-bold" for="subject">Subject</label>
                        <div class="col-md-8">
                            <input type="text" name="appointment[subject]" id="subject" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label class="col-md-2 col-form-label text-md-end fw-bold" for="cost">Cost</label>
                        <div class="col-md-8">
                            <input type="number" name="appointment[cost]" step="0.01" id="cost" class="form-control">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mt-3" x-show="responseType == 'Prescription'">
                    <legend>Prescription</legend>

                    @error('prescription.*')
                    <span class=" invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group row">
                        <label for="tablets" class="col-md-2 col-form-label fw-bold text-md-end">Tablets</label>
                        <div class="col-md-8">
                            <input type="text" name="prescription[tablets]" id="tablets" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="tablets" class="col-md-2 col-form-label fw-bold text-md-end">Cost</label>
                        <div class="col-md-8">
                            <input type="number" step="0.01" name="prescription[cost]" id="tablets"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="chemists" class="col-md-2 col-form-label fw-bold text-md-end">Chemistries</label>
                        <div class="col-md-8">
                            <input type="text" step="0.01" name="prescription[cost]" id="chemists"
                                class="form-control" placeholder="Chemistry 1, Chemistry 2">
                        </div>
                    </div>

                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger">Sure</button>
            </div>
        </form>
    </div>
</div>