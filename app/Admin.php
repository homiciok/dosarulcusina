<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;;
use Illuminate\Contracts\Auth\Authenticatable;



class Admin extends Model implements Authenticatable

{
    use Notifiable;

}
