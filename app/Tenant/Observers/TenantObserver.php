<?php

namespace App\Tenant\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{

    /**
     * Handle the Tenant (Prefeitura) "creating" event.
     *
     * @param  Illuminate\Database\Eloquent\Model; $model
     * @return void
     */
    public function creating(Model $model)
    {
        $managerTenant = app(ManagerTenant::class);
        $identify = $managerTenant->getTenantIdentify();

        if ($identify)
            $model->prefeitura_id = $identify;
    }
}
