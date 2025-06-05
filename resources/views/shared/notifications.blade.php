@session('success')
    <div class="alert alert-success">
        {{ $value }}
    </div>
@endsession

@session('error')
    <div class="alert alert-danger">
        {{ $value }}
    </div>
@endsession