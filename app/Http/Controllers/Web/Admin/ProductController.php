<?php

namespace App\Http\Controllers\Web\Admin;

use App\Exceptions\Web\WebServiceExplainedException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\WebBaseController;
use App\Http\Forms\Web\ProductWebForm;
use App\Http\Requests\Web\ProductWebRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends WebBaseController
{
    public function index() {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return $this->adminPagesView('products.index', compact('products'));
    }

    public function create() {
        $product_web_form = ProductWebForm::inputGroups(null);
        $edit = false;
        return $this->adminPagesView('products.form', compact('product_web_form', 'edit'));
    }

    public function edit($id) {
        $product = $this->getProduct($id);
        $product_web_form = ProductWebForm::inputGroups($product);
        $edit = true;
        return $this->adminPagesView('products.form', compact('product_web_form', 'edit'));
    }

    public function storeUpdate(ProductWebRequest $request) {
        $product = new Product();
        if($request->id) {
            $product = $this->getProduct($request->id);
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        $this->edited();
        return redirect()->route('admin.product.index');

    }


    public function delete($id) {
        $product = $this->getProduct($id);
        $product->delete();
        $this->deleted();
        return redirect()->route('admin.product.index');

    }
    private function getProduct($id) {
        $product = Product::find($id);
        if(!$product) throw new WebServiceExplainedException('Продукт не найден!');
        return $product;
    }
}
