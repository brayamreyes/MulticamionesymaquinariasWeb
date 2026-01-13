<?php

use Illuminate\Support\Facades\Route;

Route::get('/producto/{slug}', \App\Livewire\Products\Product::class)->name('product.show');
Route::get('/cotizar/{slug}', \App\Livewire\Products\Quotation::class)->name('product.quotation');
Route::get('/blog/{slug}', \App\Livewire\Posts\Post::class)->name('post.show');

Route::get('/leads', function (HubSpot\Discovery\Discovery $hubspot) {
    return response()->json($hubspot->crm()->contacts()->basicApi()->getPage(100));
});

Route::get('/{slug?}', \App\Livewire\Page::class)->name('page');

