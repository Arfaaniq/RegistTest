<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $produk_id
 * @property int $user_id
 * @property string $action
 * @property array<array-key, mixed>|null $old_values
 * @property array<array-key, mixed>|null $new_values
 * @property string $changes_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Produk $produk
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory whereChangesDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory whereNewValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory whereOldValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory whereProdukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProdukHistory whereUserId($value)
 * @mixin \Eloquent
 */
class ProdukHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'user_id',
        'action',
        'old_values',
        'new_values',
        'changes_description'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}