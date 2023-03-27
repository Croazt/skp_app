<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class SameYear implements Rule
{
    private string $otherDate;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $otherDate)
    {
        $this->otherDate = $otherDate;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $yearDate = Carbon::parse($value)->format('Y');
        $yearOtherDate = Carbon::parse($this->otherDate)->format('Y');
        //
        return $yearDate == $yearOtherDate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tahun rentang periode harus sama.';
    }
}
