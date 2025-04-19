@props(['id','is_active' => false])

<div class="tab-pane fade show {{ $is_active ? 'active' : '' }}" id="pills-{{ $id }}" role="tabpanel"
    aria-labelledby="pills-{{ $id }}-tab">
    {{ $slot }}
</div>
