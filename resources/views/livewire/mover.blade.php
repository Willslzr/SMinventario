<button type="submit">preciona prueba</button>

@push('custom-scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('success', () => {
            alert('Prueba! aqui van los movimientos')
        });
    });
</script>
@endpush
