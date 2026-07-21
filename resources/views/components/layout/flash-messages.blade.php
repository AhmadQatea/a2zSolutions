@if (session('success'))
    <div class="a2z-flash a2z-flash--success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="a2z-flash a2z-flash--error" role="alert">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="a2z-flash a2z-flash--error" role="alert">
        <ul class="a2z-flash__list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
