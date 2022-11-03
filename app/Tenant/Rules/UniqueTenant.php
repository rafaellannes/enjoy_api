<?php

namespace App\Tenant\Rules;

use App\Tenant\ManagerTenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueTenant implements Rule
{
    protected $table, $value, $collumn;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $table,  $value = null, $collumn = 'id')
    {
        $this->table = $table;
        $this->value = $value;
        $this->column = $collumn;
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
        $prefeitura_id = app(ManagerTenant::class)->getTenantIdentify();

        $register = DB::table($this->table)
            ->where($attribute, $value)
            ->where('prefeitura_id', $prefeitura_id)
            ->first();


        if ($register && $register->{$this->column} == $this->value)
            return true;

        return is_null($register);
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O valor para :attribute já está em uso.';
    }
}
