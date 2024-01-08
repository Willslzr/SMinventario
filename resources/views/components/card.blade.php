<div class="card container-fluid py-0 my-0 col-12">
    @if ($header)
    <div class="card-header pb-0">
        <div class="bg-gradient-info shadow-primary border-radius-lg pt-3 pb-2">
        {{ $header }}
        </div>
    </div>
    @endif
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            {{ $body }}
        </div>
    </div>
    @if (isset($footer))
    <div class="card-footer">
        {{ $footer }}
    </div>
    @endif
</div>
