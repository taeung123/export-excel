<?php 

namespace VCComponent\Laravel\Export\Policies;

use VCComponent\Laravel\Export\Contracts\ExportPolicyInterface;

class ExportPolicy implements ExportPolicyInterface
{
    public function before($user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }
    public function view($user, $model)
    {
        return $user->hasPermission('view-export');
    }

}