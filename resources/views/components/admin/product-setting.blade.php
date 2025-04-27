@props(['existing' => []])
@php
    $existing = (object) $existing;
    $settings = [
        'is_new' => 'Is New',
        'is_featured' => 'Is Featured',
        'is_best_selling' => 'Is Best Selling',
        'is_taxable' => 'Is Taxable',
        'is_outof_stock' => 'Is Out of Stock',
        'is_comming' => 'Coming Soon',
    ];
@endphp

<div class="row">
    @foreach ($settings as $key => $label)
        <div class="col-lg-2">
            <div class="input-check">
                <input type="checkbox" name="settings[]" id="settings-{{ $key }}" value="{{ $key }}"
                    class="form-check-input"
                    {{ old('settings') ? (in_array($key, old('settings', [])) ? 'checked' : '') : ($existing->$key ?? false ? 'checked' : '') }}>
                <label class="form-label" for="settings-{{ $key }}">{{ $label }}</label>
            </div>
        </div>
    @endforeach
</div>
