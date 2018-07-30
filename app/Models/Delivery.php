<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    // define os campos que podem ser salvos diretamente via request
    protected $fillable = ['client', 'delivery_date', 'starting_point', 'endpoint'];
    
    // converte o campo delivery_date para objeto data do tipo Carbon
    protected $dates = ['delivery_date'];
    
    
    // Mutator que automaticamente converte o campo client para maiúsculas ao setá-lo 
    public function setClientAttribute($value)
    {
        $this->attributes['client'] = mb_strtoupper($value, 'UTF-8');
    }
    
    // Accessor que automaticamente converte o campo client para maiúsculas ao recuperá-lo
    public function getClientAttribute($value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }
    
    
    // Mutator que automaticamente converte o campo nome para maiúsculas ao setá-lo
    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    
    // Accessor que automaticamente converte o campo nome para maiúsculas ao recuperá-lo
    public function getDeliveryDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');
    }
}
