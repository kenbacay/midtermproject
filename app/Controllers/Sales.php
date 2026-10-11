<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;

class Sales extends BaseController
{
    public function newSale(): string
    {
        return view('sales/new', [
            'products'  => (new ProductModel())->where('stock_quantity >', 0)->findAll(),
            'customers' => (new CustomerModel())->findAll(),
        ]);
    }

    public function create()
    {
        $rules = [
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|greater_than[0]',
            'customer_id' => 'permit_empty|integer',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter valid sale details.');
        }

        $productModel = new ProductModel();
        $product = $productModel->find($this->request->getPost('product_id'));

        if (! $product) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Product not found.');
        }

        $quantity = (int) $this->request->getPost('quantity');

        if ($quantity > $product['stock_quantity']) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Not enough stock. Available stock: ' . $product['stock_quantity']
                );
        }

        $totalPrice = $product['price'] * $quantity;

        $saleModel = new SaleModel();

        $saleModel->insert([
            'product_id'  => $product['id'],
            'customer_id' => $this->request->getPost('customer_id') ?: null,
            'sold_by'     => session()->get('user_id'),
            'quantity'    => $quantity,
            'total_price' => $totalPrice,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        $productModel->update($product['id'], [
            'stock_quantity' => $product['stock_quantity'] - $quantity,
        ]);

        return redirect()->to('/sales/history')
            ->with('success', 'Sale recorded successfully.');
    }

    public function history(): string
    {
        $sales = (new SaleModel())
            ->select(
                'sales.*, 
                products.name AS product_name,
                customers.full_name AS customer_name,
                users.full_name AS staff_name'
            )
            ->join('products', 'products.id = sales.product_id')
            ->join('customers', 'customers.id = sales.customer_id', 'left')
            ->join('users', 'users.id = sales.sold_by')
            ->orderBy('sales.created_at', 'DESC')
            ->findAll();

        return view('sales/history', [
            'sales' => $sales,
        ]);
    }
}