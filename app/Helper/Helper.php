<?php

namespace App\Helper;

use App\Models\PackageType;

function packageName($package_code)
{
    return PackageType::where('package_code', $package_code)->first()->package_name;
}
