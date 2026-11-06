<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $url = $this->img ? url('storage/' . $this->img) : null;

        return [
            'id' => $this->product_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => (float) $this->price,
            'stock' => (int) $this->stock,
            'category_id' => $this->category_id,
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category?->category,
            ],
            'image' => $url,      // dipakai halaman toko
            'img_url' => $url,    // dipakai halaman admin
            'specifications' => array_merge(
                ['Category' => $this->category?->category],
                $this->specifications ?? []
            ),
        ];
    }
}