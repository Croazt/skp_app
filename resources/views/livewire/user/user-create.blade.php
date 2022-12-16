<x-slot name="header_content">
    <h1>{{ __('Tambah Pengguna') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('users.index') }}">Pengguna</a></div>
        <div class="breadcrumb-item"><a href="{{ route('users.create') }}">Tambah</a></div>
    </div>
</x-slot>

@include('livewire.user.user-form')