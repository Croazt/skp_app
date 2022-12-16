@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:tw-grid md:tw-grid-cols-3 md:tw-gap-6']) }}>
    <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="mt-5 md:tw-mt-0 md:tw-col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="tw-px-4 tw-py-5 tw-bg-white sm:tw-p-6 shadow {{ isset($actions) ? 'sm:tw-rounded-tl-md sm:tw-rounded-tr-md' : 'sm:tw-rounded-md' }}">
                <div class="tw-grid tw-grid-cols-6 tw-gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="tw-flex tw-items-center tw-justify-end tw-px-4 tw-py-3 tw-bg-gray-50 tw-text-right sm:tw-px-6 tw-shadow sm:tw-rounded-bl-md sm:tw-rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
