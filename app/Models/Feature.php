<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'features';

    protected $primaryKey = 'id';

    protected $fillable = ['description'];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    public function featureable(): MorphTo
    {
        return $this->morphTo();
    }

    public function courts()
    {
        return $this->morphedByMany(Court::class, 'featureable');
    }

    public function memberships()
    {
        return $this->morphedByMany(Membership::class, 'featureable');
    }
}
