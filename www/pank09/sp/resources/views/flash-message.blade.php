@if (Session::has('success'))
<div class="notification px-3 py-4 fs-9 mb-3 fw-m success">
    {{ Session::get('success') }}
</div>
@endif

@if (Session::has('error'))
<div class="notification px-3 py-4 fs-9 mb-3 fw-m error">
    {{ Session::get('error') }}
</div>
@endif

@if (Session::has('info'))
<div class="notification px-3 py-4 fs-9 mb-3 fw-m">
    {{ Session::get('info') }}
</div>
@endif