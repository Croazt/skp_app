<?php

namespace App\Rules;

use App\Models\Skp;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class UniqueYear implements Rule
{
    private string $otherDate;
    private Skp $skp;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Skp $skp = new Skp())
    {
        $this->skp = $skp;
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
        $databaseRecord = Skp::whereYear('periode_awal',$yearDate)->get();
        if($this->skp->exists){
            $databaseRecord = Skp::whereYear('periode_awal',$yearDate)->where('id','<>',$this->skp->id)->get();
        }

        return $databaseRecord->count() === 0; 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tahun rentang periode tidak boleh sama dengan periode lain.';
    }
}
