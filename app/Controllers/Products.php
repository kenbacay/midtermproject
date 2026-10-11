<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    public function index(): string
    {
        $productModel = new ProductModel();

        return view('products/index', [
            'products' => $productModel->findAll(),
        ]);
    }

    public function newProduct(): string
    {
        return view('products/new');
    }

    public function create()
    {
        $rules = [
            'name'           => 'required|max_length[100]',
            'price'          => 'required|decimal',
            'stock_quantity' => 'required|integer',
            'image'          => 'permit_empty|is_image[image]|max_size[image,2048]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $imageName = null;
        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && ! $image->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/products/';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            if (! is_writable($uploadPath)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Upload folder is not writable.');
            }

            $imageName = $image->getRandomName();
            $image->move($uploadPath, $imageName);
        }

        $productModel = new ProductModel();

        $productModel->insert([
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $imageName,
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/products');
    }

    public function edit($id): string
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (! $product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Product not found'
            );
        }

        return view('products/edit', [
            'product' => $product,
        ]);
    }

    public function update($id)
    {
        $rules = [
            'name'           => 'required|max_length[100]',
            'price'          => 'required|decimal',
            'stock_quantity' => 'required|integer',
            'image'          => 'permit_empty|is_image[image]|max_size[image,2048]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (! $product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Product not found'
            );
        }

        $imageName = $product['image'];
        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && ! $image->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/products/';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            if (! is_writable($uploadPath)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Upload folder is not writable.');
            }

            $imageName = $image->getRandomName();
            $image->move($uploadPath, $imageName);
        }

        $productModel->update($id, [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $imageName,
        ]);

        return redirect()->to('/products');
    }

    public function delete($id)
    {
        $productModel = new ProductModel();
        $productModel->delete($id);

        return redirect()->to('/products');
    }
}