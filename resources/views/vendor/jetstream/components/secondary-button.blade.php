<button {{ $attributes->merge(['type' => 'button', 'class' => 'tw-inline-flex  tw-items-center  tw-px-4  tw-py-2  tw-bg-white  tw-border  tw-border-gray-300  tw-rounded-md  tw-font-semibold  tw-text-xs  tw-text-gray-700  tw-uppercase  tw-tracking-widest  tw-shadow-sm hover:tw-text-gray-500 focus:tw-outline-none focus:tw-border-blue-300 focus:tw-ring focus:tw-ring-blue-200 active:tw-text-gray-800 active:tw-bg-gray-50 disabled:tw-opacity-25 transition']) }}>
    {{ $slot }}
</button>
