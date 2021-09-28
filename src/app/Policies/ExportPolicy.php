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
        return $user->hasPermission('view-Export');
    }

    public function create($user)
    {
        return $user->hasPermission('create-Export');
    }

    public function updateItem($user, $model)
    {
        return $user->hasPermission('update-item-Export');
    }

    public function update($user)
    {
        return $user->hasPermission('update-Export');
    }

    public function delete($user, $model)
    {
        return $user->hasPermission('delete-Export');
    }
}