<?php

namespace App\DataTables;

use App\Models\ProductVariantItem;
use App\Models\VendorProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {

                $editBtn = "<a href='" . route('vendor.product-variant-item.edit', $query->id) . "' class='btn btn-primary mx-2'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('vendor.product-variant-item.destroy', $query->id) . "' class='btn btn-danger ml-2 delet-item my-2'><i class='fas fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('variant_name', function ($query) {
                return $query->ProductVariant->name;
            })
            ->addColumn('status', function ($query) {

                if ($query->status == 1) {
                    $button = '<div class="form-check form-switch">
                     <input class="form-check-input change-status" checked data-id="' . $query->id . '" type="checkbox" id="flexSwitchCheckDefault">
                     </div>';
                } else {

                    $button = '<div class="form-check form-switch">
                <input class="form-check-input change-status"  data-id="' . $query->id . '" type="checkbox" id="flexSwitchCheckDefault">
                </div>';
                }
                return $button;
            })
            ->addColumn('is_defult', function ($query) {

                if ($query->is_default == 1) {
                    return '<i class="badge bg-success">Yes</i>';
                } else {
                    return '<i class="badge bg-danger">No</i>';
                }
            })
            ->rawColumns(['status', 'action', 'is_defult'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model->where('product_variant_id', request()->variantId)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('productvariantitem-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->width(200),
            Column::make('variant_name')->width(200),
            Column::make('price'),
            Column::make('is_defult'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProductVariantItem_' . date('YmdHis');
    }
}
