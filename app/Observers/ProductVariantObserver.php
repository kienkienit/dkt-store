<?php

namespace App\Observers;

use App\Models\ProductVariant;

class ProductVariantObserver
{
    /**
     * Handle the ProductVariant "created" event.
     */
    public function created(ProductVariant $productVariant)
    {
        $this->updateProductPrice($productVariant);
    }

    /**
     * Handle the ProductVariant "updated" event.
     */
    public function updated(ProductVariant $productVariant): void
    {
        $this->updateProductPrice($productVariant);
    }

    protected function updateProductPrice(ProductVariant $productVariant)
    {
        $product = $productVariant->product;
        
        if ($product->price == 0 && $product->variants()->exists()) {
            $firstVariant = $product->variants()->first();

            if ($firstVariant) {
                $product->price = $firstVariant->price;
                $product->save();
            }
        }
    }

    /**
     * Handle the ProductVariant "deleted" event.
     */
    public function deleted(ProductVariant $productVariant): void
    {
        //
    }

    /**
     * Handle the ProductVariant "restored" event.
     */
    public function restored(ProductVariant $productVariant): void
    {
        //
    }

    /**
     * Handle the ProductVariant "force deleted" event.
     */
    public function forceDeleted(ProductVariant $productVariant): void
    {
        //
    }
}
