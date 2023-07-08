<?php

namespace App\Controllers;

use App\Models\AttributeModel;

class Home extends BaseController
{
    public function index()
    {
        $attr = new AttributeModel();
        $data['page_title'] = 'Products';
        $data['attributes'] = $attr->findAll();
        $data['details'] = db_connect()->query("SELECT prodetails.pro_name,prodetails.pro_id,attr_variation.attr_variation_name,attr_variation.attr_variation_price FROM `prodetails` JOIN attr_variation ON prodetails.pro_id = attr_variation.pro_id")->getResultArray();
        return view('index', $data);
    }

    public function properties()
    {
        if ($this->request->isAJAX()) {
            $data['attr_id'] = $this->request->getVar('attr_id');
            if ($data['attr_id'] != 0) {
                return view('properties', $data);
            }
        }
    }

    public function prodetails()
    {
        if ($this->request->is('post')) {
            $product_name = $this->request->getVar('pro_name');
            if (count($this->request->getVar('attr_variation_price')) > 0 && $product_name != NULL) {
                $db      = \Config\Database::connect();
                $data = [];
                $pro_details = [
                    'pro_name' => $product_name,
                ];
                $db->table('prodetails')->insert($pro_details);
                $id = $db->insertID();
                for ($j = 0; $j < count($this->request->getVar('attr_variation_price')); $j++) {
                    $attr_variation_price = $this->request->getVar('attr_variation_price')[$j];
                    $attr_variation_name = $this->request->getVar('attr_variation_name')[$j];
                    $data[] = [
                        'pro_id' => $id,
                        'attr_variation_name' => $attr_variation_name,
                        'attr_variation_price' => $attr_variation_price,
                    ];
                }
                $result = $db->table('attr_variation')->insertBatch($data);
                if ($result != 0) {
                    session()->setFlashdata('status', 'Data Inserted Successfully!');
                    session()->setFlashdata('color', 'success');
                    return redirect('/');
                } else {
                    session()->setFlashdata('status', 'Oops Something went wrong!');
                    session()->setFlashdata('color', 'danger');
                    return redirect('/');
                }
            } else {
                session()->setFlashdata('status', 'Kindly fill variation details!');
                session()->setFlashdata('color', 'error');
                return redirect('/');
            }
        }
    }
}
