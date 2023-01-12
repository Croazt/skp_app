<x-slot name="header_content">
    <h1>{{ __('Dashboard') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
    </div>
</x-slot>

<div class="tw-h-max tw-w-full tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg tw-flex tw-flex-col">
    <div class="tw-w-full tw-mt-14">
        <p class="tw-font-black tw-text-5xl tw-text-center">
            SELAMAT DATANG
        </p>
    </div>
    <div class="tw-mx-auto tw-my-6">
        <img src="{{ asset('images/app_logobg.png') }}" class="tw-w-64 tw-h-64" alt="" srcset="">
    </div>
    <div>
        <p class=" tw-font-black tw-text-5xl tw-text-center tw-mb-14">
            SKP SMA NEGERI 2 SIDRAP
        </p>
    </div>
</div>
