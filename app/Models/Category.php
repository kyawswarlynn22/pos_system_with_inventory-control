<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'categories';

    protected $fillable = ['c_name', 'description', 'del_flg'];



    public function categoryList()
    {
        return Category::orderBy('id', 'desc')
            ->where('del_flg', 0)
            ->paginate(15); 
    }

    public function categoryallList()
    {
        return Category::all();
    }

    public function categoryAdd($request)
    {
        Category::create([
            'c_name' => $request->categoryName,
            'description' => $request->categoryDescription,
        ]);
    }

    public function categoryDetail($id)
    {
        return Category::where('id', $id)->first();
    }

    public function categoryUpdate($request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->update([
                'c_name' => $request->categoryName,
                'description' => $request->categoryDescription,
            ]);
        }
    }

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
