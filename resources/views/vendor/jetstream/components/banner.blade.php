@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}"
            :class="{ 'tw-bg-indigo-500': style == 'success', 'tw-bg-red-700': style == 'danger', 'tw-bg-gray-500': style != 'success' && style != 'danger' }"
            style="display: none;"
            x-show="show && message"
            x-init="
                document.addEventListener('banner-message', event => {
                    style = event.detail.style;
                    message = event.detail.message;
                    show = true;
                });
            ">
    <div class="tw-max-w-screen-xl tw-mx-auto tw-py-2 tw-px-3 sm:tw-px-6 lg:tw-px-8">
        <div class="tw-flex tw-items-center tw-justify-between tw-flex-wrap">
            <div class="tw-w-0 tw-flex-1 tw-flex tw-items-center tw-min-w-0">
                <span class="tw-flex tw-p-2 tw-rounded-lg" :class="{ 'tw-bg-indigo-600': style == 'success', 'tw-bg-red-600': style == 'danger' }">
                    <svg x-show="style == 'success'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="style == 'danger'" class="tw-h-5 tw-w-5 tw-text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="style != 'success' && style != 'danger'" class="tw-h-5 tw-w-5 tw-text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>

                <p class="tw-ml-3 tw-font-medium tw-text-sm tw-text-white tw-truncate" x-text="message"></p>
            </div>

            <div class="tw-shrink-0 sm:tw-ml-3">
                <button
                    type="button"
                    class="tw--mr-1 tw-flex p-2 tw-rounded-md focus:tw-outline-none sm:tw--mr-2 tw-transition"
                    :class="{ 'hover:tw-bg-indigo-600 focus:tw-bg-indigo-600': style == 'success', 'hover:tw-bg-red-600 focus:tw-bg-red-600': style == 'danger' }"
                    aria-label="Dismiss"
                    x-on:click="show = false">
                    <svg class="tw-h-5 tw-w-5 tw-text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />tw-
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
