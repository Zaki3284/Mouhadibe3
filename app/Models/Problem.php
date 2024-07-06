<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    // protected $table = 'problems';

    protected $fillable = ['description', 'priority'];
}
