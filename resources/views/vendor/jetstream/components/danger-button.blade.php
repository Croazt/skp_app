<button {{ $attributes->merge(['type' => 'button', 'class' => 'tw-inline-flex tw-items-center tw-justify-center tw-px-4 tw-py-2 tw-bg-red-600 tw-border tw-border-transparent tw-rounded-md tw-font-semibold tw-text-xs tw-text-white tw-uppercase tw-tracking-widest hover:tw-bg-red-500 focus:tw-outline-none focus:tw-border-red-700 focus:tw-ring focus:tw-ring-red-200 active:tw-bg-red-600 disabled:tw-opacity-25 transition']) }}>
    {{ $slot }}
</button>
