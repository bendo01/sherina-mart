<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Variety;
use App\Models\Category;

class Product extends Model
{
    use HasUuids;
    protected $fillable = ["code", "name"];
    protected $casts = ["code" => "integer", "name" => "string"];

    public function variety(): BelongsTo
    {
        return $this->belongsTo(Variety::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
