@extends('Backend.layouts.app')
@section('main-content')

<section>
    <x-card>
        <x-slot name="header">
                <h4 class="text-white text-capitalize ps-3">Inventario</h4>
        </x-slot>
        <x-slot name="body">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                    </div>
                </div>
            </div>
        </x-slot>
    </x-card>

</section>

@endsection
@push('custom-scripts')
@endpush
