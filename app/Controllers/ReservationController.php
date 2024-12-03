<?php

namespace App\Controllers;

use Config\MongoDB;

class ReservationController extends BaseController
{
    public function create()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name'   => 'required|min_length[3]|max_length[100]',
            'phone'  => 'required|numeric|min_length[10]',
            'date'   => 'required|valid_date[Y-m-d]',
            'time'   => 'required|valid_date[H:i]',
            'guests' => 'required|integer|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors()
            ]);
        }

        $db = \Config\MongoDB::connect();
        $collection = $db->reservations;

        $newReservation = [
            'name'   => $this->request->getPost('name'),
            'phone'  => $this->request->getPost('phone'),
            'date'   => $this->request->getPost('date'),
            'time'   => $this->request->getPost('time'),
            'guests' => (int)$this->request->getPost('guests')
        ];

        $result = $collection->insertOne($newReservation);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Rezervasyon başarıyla oluşturuldu!',
            'id'      => (string)$result->getInsertedId()
        ]);
    }

    public function index()
    {
        $db = MongoDB::connect();
        $collection = $db->reservations;

        $reservations = $collection->find()->toArray();

        foreach ($reservations as $reservation) {
            echo 'ID: ' . (string)$reservation->_id . '<br>';
            echo 'İsim: ' . $reservation->name . '<br>';
            echo 'Telefon: ' . $reservation->phone . '<br>';
            echo 'Tarih: ' . $reservation->date . '<br>';
            echo 'Saat: ' . $reservation->time . '<br>';
            echo 'Kişi Sayısı: ' . $reservation->guests . '<br><br>';
        }
    }
    public function update($id)
    {
        $db = MongoDB::connect();
        $collection = $db->reservations;

        $updateData = [
            'name' => 'Jane Doe',
            'phone' => '555-5678',
            'guests' => 5
        ];

        $result = $collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => $updateData]
        );

        if ($result->getModifiedCount() > 0) {
            echo 'Rezervasyon güncellendi!';
        } else {
            echo 'Güncelleme başarısız!';
        }
    }
    public function delete($id)
    {
        try {
            $db = MongoDB::connect();
            $collection = $db->reservations;

            $result = $collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);

            if ($result->getDeletedCount() > 0) {
                echo 'Rezervasyon silindi!';
            } else {
                echo 'Silme işlemi başarısız!';
            }
        } catch (\Exception $e) {
            echo 'Bir hata oluştu: ' . $e->getMessage();
        }
    }



}
