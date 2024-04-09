<?php

namespace App\Models;

use App\Services\UniqueLinkGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Link extends Model
{
    use HasFactory;

	protected $fillable = [
		'original_link',
		'life_seconds',
		'redirects_count',
	];

	protected $guarded = [
		'is_infinity',
		'short_link',
	];

	protected static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			$model->is_infinity = $model->redirects_count === 0;
			$model->short_link = UniqueLinkGenerator::generate();
		});
	}

	public function isExpired(): bool
	{
		$expire_time = Carbon::parse($this->created_at)->addSeconds($this->life_seconds);
		return now() > $expire_time;
	}

	public function hasRedirectAttempts(): bool
	{
		return $this->is_infinity || $this->redirects_count > 0;
	}

	public function redirectsDecrement(): bool
	{
		if($this->is_infinity) {
			return true;
		}
		if($this->redirects_count === 1) {
			return $this->delete();
		}

		$this->redirects_count -= 1;
		return $this->save();
	}
}
