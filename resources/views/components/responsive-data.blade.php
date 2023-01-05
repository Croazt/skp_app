<div {{ $attributes->merge(['class' => 'tw-flex']) }}>
    <div class="tw-w-5/12 sm:tw-text-sm md:tw-text-base tw-text-xs tw-font-bold">
        {{ $title }}
    </div>
    <span class="tw-font-bold  sm:tw-text-sm md:tw-text-base tw-text-xs">:</span>
    <div class="tw-ml-1 tw-w-6/12 font-medium sm:tw-text-sm md:tw-text-base tw-text-xs tw-break-words">
        {{ $value }}
    </div>
</div>