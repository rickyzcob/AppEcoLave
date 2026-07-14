<?php

namespace App\Manager;

class ScopeManager
{
    public function isScopeAdmin()
    {
        $scope = auth()->user()->scope;
        $scopeAdmin = 'admin';

        return $scope == $scopeAdmin;
    }

    public function isScopeClient()
    {
        $scope = auth()->user()->scope;
        $scopeAdmin = 'client';

        return $scope == $scopeAdmin;
    }

    public function isScopeAdminAndWasher()
    {
        $scope = auth()->user()->scope;

        return in_array($scope, ['admin', 'washer']);
    }

    public function isScopeWasher()
    {
        $scope = auth()->user()->scope;
        $scopeAdmin = 'washer';

        return $scope == $scopeAdmin;
    }

    public function getScopeIdentify()
    {
        return auth()->user()->scope;
    }

}
