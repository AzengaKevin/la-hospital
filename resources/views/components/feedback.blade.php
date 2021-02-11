<div>
    <!-- Check and display errors in session is available -->
    @if ($errors->any())
    <div class="alert alert-danger text-start" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session()->has('message'))
    <div class="alert alert-success text-start" role="alert">
        {{ session('message') }}
    </div>
    @endif
</div>