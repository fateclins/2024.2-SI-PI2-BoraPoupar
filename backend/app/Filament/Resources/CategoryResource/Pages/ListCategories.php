<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use App\Models\Category;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $incomeCategories = Category::where('type', 'income')->pluck('id')->toArray();

        $expenseCategories = Category::where('type', 'expense')->pluck('id')->toArray();

        return [
            'all' => Tab::make('Todas')
                ->modifyQueryUsing(function ($query) {
                    return $query;
                }),

            'income' => Tab::make('Receitas')
                ->modifyQueryUsing(function ($query) use ($incomeCategories) {
                    return $query->whereIn('id', $incomeCategories);
                }),

            'expense' => Tab::make('Despesas')
                ->modifyQueryUsing(function ($query) use ($expenseCategories) {
                    return $query->whereIn('id', $expenseCategories);
                }),
        ];
    }
}
