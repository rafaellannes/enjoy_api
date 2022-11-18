<?php

namespace App\Tenant\Scopes;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {


        $identify = app(ManagerTenant::class)->getTenantIdentify();
        if ($identify)
            $builder->where('prefeitura_id', $identify);



        /*      try {
            return
             Auth::user();  Auth::guard('sanctum')->user();
        } catch (\Exception $e) {
            return $e->getMessage();
        } */
    }
}
