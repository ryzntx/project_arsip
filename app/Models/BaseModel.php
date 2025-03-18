<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yungts97\LaravelUserActivityLog\Traits\Loggable;

class BaseModel extends Model
{
    use Loggable;
}
