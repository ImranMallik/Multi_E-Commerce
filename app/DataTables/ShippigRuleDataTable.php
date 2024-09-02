<?php

namespace App\DataTables;

use App\Models\ShippigRule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippigRuleDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.shipping-rules.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.shipping-rules.destroy', $query->id) . "' class='btn btn-danger ml-2 delet-item'><i class='fas fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button = '<label class="custom-switch mt-2">
                <input type="checkbox" checked data-id="' . $query->id . '" name="custom-switch-checkbox" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
              </label>';
                } else {

                    $button = '<label class="custom-switch mt-2">
                <input type="checkbox" data-id="' . $query->id . '" name="custom-switch-checkbox" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
              </label>';
                }
                return $button;
            })
            ->addColumn('type', function ($query) {
                if ($query->type === 'min_cost') {
                    return '<i class="badge badge-primary">Minimum Order Amount</i>';
                } else {
                    return   '<i class="badge badge-success">Flat Amount</i>';
                }
            })
            ->addColumn('min_cost', function ($query) {
                if ($query->type === 'min_cost') {
                    return $this->currencyIcon . $query->min_cost;
                } else {
                    return $this->currencyIcon . '0';
                }
            })
            ->addColumn('cost', function ($query) {
                return $this->currencyIcon . $query->cost;
            })
            ->rawColumns(['action', 'cost', 'status', 'type', 'min_cost'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ShippigRule $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('shippigrule-table')
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
            Column::make('name'),
            Column::make('type'),
            Column::make('min_cost'),
            Column::make('cost'),
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
        return 'ShippigRule_' . date('YmdHis');
    }
}
