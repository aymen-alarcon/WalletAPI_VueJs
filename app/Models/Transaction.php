<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = ["wallet_id", "type", "amount", "description", "balance_after", "receiver_wallet_id"];

    public function wallets():BelongsTo{
        return $this->belongsTo(Wallet::class, "wallet_id");
    }
}
