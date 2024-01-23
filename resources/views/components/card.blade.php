<div class="card container-fluid py-0 my-0 col-12 card-shadow bg-gradient-light card-border-rounded">
    @if ($header)
    <div class="card-header pb-0">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 px-3 pb-2 rounded">
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
