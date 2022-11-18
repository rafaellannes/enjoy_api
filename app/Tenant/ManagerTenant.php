<?php

namespace App\Tenant;


class ManagerTenant
{
    public function getTenantIdentify()
    {

        if (request()->has('uuid')) {
            $prefeitura = \App\Models\Prefeitura::where('uuid', request('uuid'))->first();
            if ($prefeitura) {
                return $prefeitura->id;
            }
        }


        /* dd(auth('sanctum')->check()); */
        /*  dd(request('uuid')); */
        /*  return auth('sanctum')->check(); */
        /*         if (auth()->check()) {

            return auth()->user()->prefeitura_id;
        } else {
            if (request()->has('uuid')) {
                $prefeitura = \App\Models\Prefeitura::where('uuid', request('uuid'))->first();
                if ($prefeitura)
                    return $prefeitura->id;
            }
        } */


        /*  dd(auth()->user()); */
        // return auth()->check() ? auth()->user()->prefeitura_id : '';
    }

    public function getTenant()
    {
        return auth()->check() ? auth()->user()->prefeitura : '';
    }

    public function getTenantUrl()
    {
        return auth()->check() ? auth()->user()->prefeitura->url : '';
    }

    public function isAdmin(): bool
    {
        return auth()->user->isAdmin ? true : false;
    }
}
