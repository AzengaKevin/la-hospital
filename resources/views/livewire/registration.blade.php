<form class="form-signup text-center" novalidate>

    <div>
        <a href="{{ route('home') }}">
            <x-logo height="64" />
        </a>
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    </div>


    <div class="text-start">
        <label class="fw-bold form-label" for="name">Name</label>
        <input type="text" id="name" class="form-control" placeholder="Name" required autofocus>
    </div>

    <div class="row text-start mt-2">
        <div class="col-sm-6">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email Address..." value="" required>
        </div>

        <div class="col-sm-6">
            <label for="phone" class="form-label fw-bold">Phone</label>
            <input type="text" class="form-control" id="phone" placeholder="Phone Number..." value="" required>
        </div>
    </div>

    <div class="text-start mt-2">
        <label class="form-label fw-bold" for="inputPassword">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    </div>

    <div class="row align-items-center text-start mt-2">
        <div class="col-md-4 mt-2">
            <select class="form-select" id="country" required>
                <option value="">Select Gender...</option>
                @foreach (\App\Models\User::genderOptions() as $item)
                <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>

        @foreach (\App\Models\User::types() as $item)
        <div class="col-md-4 align-self-center mt-2">
            <div class="form-check">
                <input id="{{ $item }}" name="type" type="radio" class="form-check-input" value="{{ $item }}">
                <label class="form-check-label" for="{{  $item }}">{{ $item }}</label>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </div>
    <p class="mt-5 mb-3 text-muted">&copy; All rights reserved 2021</p>
</form>