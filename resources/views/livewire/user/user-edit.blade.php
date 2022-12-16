<x-slot name="header_content">
    <h1>{{ __('Ubah Pengguna') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('users.index') }}">Pengguna</a></div>
        <div class="breadcrumb-item"><a href="{{ route('users.edit', ['user'=>$this->user]) }}">Ubah</a></div>
        <div class="breadcrumb-item"><a href="{{ route('users.edit', ['user'=>$this->user]) }}">{{ $this->user->getKey() }}</a></div>
    </div>
</x-slot>

@include('livewire.user.user-form')