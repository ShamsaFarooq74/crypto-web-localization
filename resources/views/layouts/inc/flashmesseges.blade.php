@if (session('success'))
<div class="container-fluid">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('danger'))
    <div class="container-fluid">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('danger') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="container-fluid">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session('errors') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('warning'))
            <div class="container-fluid">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('warning') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('info'))
                <div class="container-fluid">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>{{ session('info') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong> {!! implode('', $errors->all('<div>:message</div>')) !!}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div id="message">
                    </div>
