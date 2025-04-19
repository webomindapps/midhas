@props(['id', 'title', 'is_active' => false])

<li class="nav-item" role="presentation">
    <button class="nav-link {{ $is_active ? 'active' : '' }}" id="pills-{{ $id }}-tab" data-bs-toggle="pill"
        data-bs-target="#pills-{{ $id }}" type="button" role="tab" aria-controls="pills-{{ $id }}"
        aria-selected="true">{{ $title }}</button>
</li>
