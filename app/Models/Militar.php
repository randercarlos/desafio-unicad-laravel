<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Militar extends Model
{
    // especifica a tabela do banco de dados ao qual essa model representa
    protected $table = 'militares';
    
    // define os campos que podem ser salvos diretamente via request
    protected $fillable = ['nome', 'identidade', 'data_nascimento', 'servico_militar_obrigatorio', 'patente'];
    
    // converte o campo data_nascimento para objeto data do tipo Carbon
    protected $dates = ['data_nascimento'];
    
    // converte o campo servico_militar_obrigatorio(tipo 1/0) para booleano(true/false)
    protected $casts = [
        'servico_militar_obrigatorio' => 'boolean'  
    ];
    
    const patentes = ['Soldado', 'Cabo', 'Sargento', 'Subtenente', 'Tenente', 'Capitão', 'General'];
    
    // Mutator que automaticamente converte o campo nome para maiúsculas ao setá-lo 
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = mb_strtoupper($value, 'UTF-8');
    }
    
    // Accessor que automaticamente converte o campo nome para maiúsculas ao recuperá-lo
    public function getNomeAttribute($value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }
    
    // Mutator que automaticamente converte o campo nome para maiúsculas ao setá-lo
    public function setDataNascimentoAttribute($value)
    {
        $this->attributes['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    // Accessor que automaticamente converte o campo nome para maiúsculas ao recuperá-lo
    public function getDataNascimentoAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
    
    // Accessor que automaticamente converte o campo nome para maiúsculas ao recuperá-lo
    public function getServicoMilitarObrigatorioAttribute($value)
    {
        return $value == 1 ? 'Sim' : 'Não';
    }
    
    // Accessor que automaticamente converte o campo nome para maiúsculas ao recuperá-lo
    public function setServicoMilitarObrigatorioAttribute($value)
    {
        $this->attributes['servico_militar_obrigatorio'] = ($value == true) ? '1' : '0';
    }
}
