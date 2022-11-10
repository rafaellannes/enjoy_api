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

        try {
            dd(Auth::user(), /* Auth::guard('sanctum')->user() */);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $identify = app(ManagerTenant::class)->getTenantIdentify();
        if ($identify)
            $builder->where('prefeitura_id', $identify);
    }
}
