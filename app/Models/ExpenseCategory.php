<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ExpenseCategory extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'expense_categories';

    protected $fillable = ['e_c_name', 'description', 'del_flg'];

    public function expenseCategoryAdd($request)
    {
        ExpenseCategory::create([
            'e_c_name' => $request->categoryName,
            'description' => $request->categoryDescription,
        ]);
    }

    public function getExpenseList()
    {
        return ExpenseCategory::orderBy('id', 'desc')
            ->where('del_flg', 0)
            ->paginate(15);
    }

    public function expenseCategoryDetail($id)
    {
        return ExpenseCategory::where('id', $id)->first();
    }

    public function expenseCategoryUpdate($request, $id)
    {
        $category = ExpenseCategory::find($id);
        if ($category) {
            $category->update([
                'e_c_name' => $request->categoryName,
                'description' => $request->categoryDescription,
            ]);
        }
    }

    public function expenseCategoryallList()
    {
        return ExpenseCategory::all();
    }
}
