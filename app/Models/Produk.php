<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $Nama_produk
 * @property string|null $Deskripsi
 * @property int $Harga
 * @property int $Stok
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProdukHistory> $histories
 * @property-read int|null $histories_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereNamaProduk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereStok($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produk whereUserId($value)
 * @mixin \Eloquent
 */
class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nama_produk',
        'Deskripsi', 
        'Harga',
        'Stok',
        'user_id'
    ];

    // Relasi ke User (yang membuat/mengedit produk)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke ProdukHistory
    public function histories()
    {
        return $this->hasMany(ProdukHistory::class);
    }
}