<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;


class ExpenseModel extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

  

    protected $table = 'expenses';

    protected $fillable = ['expense_categories_id', 'description', 'date', 'amount', 'photo', 'del_flg'];

    public function storeExpensedata($request)
    {
        $storeExpense = new ExpenseModel();
        $storeExpense->expense_categories_id  = $request->category_id;
        $storeExpense->description = $request->categoryDescription;
        $storeExpense->amount = $request->amount;
        if ($request->hasFile('expphoto')) {
            $extension = $request->file('expphoto')->extension();
            $filename = time() . '.' . $extension;
            $path3 = 'Expense/' . $filename;
            $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('expphoto')->getRealPath()), 'public');
            $linkpath = "https://sks.sgp1.digitaloceanspaces.com/Expense/";
            $dbstore = $linkpath . $filename;
            $storeExpense->photo = $dbstore;
        }
        $storeExpense->save();

        $cashInHand = DailyCih::max('id');
        $cashInHandBal = DailyCih::find($cashInHand);
        if ($cashInHandBal) {
            $cashInHandBal->grand_total -= $request->amount;
            $cashInHandBal->save();
        }
    }

    public function getExpenseDetail($id)
    {
        return ExpenseModel::where('id', $id)->first();
    }

    public function getExpenseList()
    {
        return ExpenseModel::join('expense_categories', 'expense_categories_id', 'expense_categories.id')
            ->select('e_c_name', 'expenses.*')
            ->orderBy('expenses.id', 'desc')
            // ->where('expense_categories_id','<>',4)
            ->paginate(15);
    }

    public function datefilter($request)
    {
        $date = $request->date;

        return $expenseDate = ExpenseModel::whereDate('created_at', $date)
            ->where('expense_categories_id','<>',4)
            ->get();
    }

    public function adminexpensedatefilter($request)
    {
        $date = $request->date;

        return $expenseDate = ExpenseModel::whereDate('created_at', $date)
            ->where('expense_categories_id',4)
            ->get();
    }

    public function updateExpense($request, $id)
    {
        $updateExpense = ExpenseModel::find($id);
        $cashInHand = DailyCih::max('id');
        $cashInHandBal = DailyCih::find($cashInHand);
        if ($cashInHandBal) {
            $cashInHandBal->grand_total += $updateExpense->amount;
            $cashInHandBal->save();
        }
        if ($updateExpense) {
            $updateData = [
                'expense_categories_id' => $request->category_id,
                'description' => $request->categoryDescription,
                'amount' => $request->amount,
            ];

            if ($request->hasFile('expphoto')) {
                $extension = $request->file('expphoto')->extension();
                $filename = time() . '.' . $extension;
                $path3 = 'Expense/' . $filename;
                $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('expphoto')->getRealPath()), 'public');
                $linkpath = "https://sks.sgp1.digitaloceanspaces.com/Expense/";
                $dbstore = $linkpath . $filename;
                $updateData['photo'] = $dbstore;
            }

            $updateExpense->update($updateData);
            if ($cashInHandBal) {
                $cashInHandBal->grand_total -= $updateExpense->amount;
                $cashInHandBal->save();
            }
        }
    }

    public function getExpense($id)
    {
        return ExpenseModel::join('expense_categories', 'expense_categories_id', 'expense_categories.id')
            ->select('e_c_name', 'expenses.*')
            ->where('expenses.id', $id)
            ->first();
    }

    public function expenseCategoryallList()
    {
        return ExpenseCategory::all();
    }

    public function delExpense($id)
    {
        $updateModel = ExpenseModel::find($id);

        $cashInHand = DailyCih::max('id');
        $cashInHandBal = DailyCih::find($cashInHand);
        if ($cashInHandBal) {
            $cashInHandBal->grand_total += $updateModel->amount;
            $cashInHandBal->save();
        }
    }
}
