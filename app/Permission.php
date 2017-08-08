<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable =
        ['name', 'description', 'display_name'];
}