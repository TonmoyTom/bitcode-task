<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function createNew(array $data): ShortLink
    {
        return static::create([
            'code' => codeGenerate(),
            'link' => $data['link'],
        ]);
    }
    public  function updateData(array $data): bool
    {
        return $this->update([
            'link' =>data_get($data, 'link', $this->link),
            'code' =>data_get($data, 'code', codeGenerate()),
        ]);
    }



}
