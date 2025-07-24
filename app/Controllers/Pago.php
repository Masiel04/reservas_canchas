<?php

namespace App\Controllers;

use App\Models\PagoModel;
use App\Models\ReservaModel;

class Pago extends BaseController
{
    public function index()
    {
        $pagoModel = new PagoModel();
        $session = session();
        if ($session->get('tipo') === 'admin') {
            $data['pagos'] = $pagoModel->getPagosConDetalles();
        } else {
            $idUsuario = $session->get('id_usuario');
            $data['pagos'] = $pagoModel->getPagosConDetallesPorUsuario($idUsuario);
        }
        return view('pago/listado', $data);
    }

    private function soloAdmin()
    {
        $session = session();
        if (!$session->has('logueado') || $session->get('tipo') !== 'admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No tienes permiso para acceder a esta sección.');
        }
    }

    public function nuevo()
    {
        $session = session();
        $reservaModel = new ReservaModel();
        if ($session->get('tipo') === 'admin') {
            $data['reservas'] = $reservaModel->findAll();
        } else {
            $idUsuario = $session->get('id_usuario');
            $data['reservas'] = $reservaModel->where('id_usuario', $idUsuario)->findAll();
        }
        return view('pago/nuevo', $data);
    }

    public function guardar()
    {
        $session = session();
        $pagoModel = new PagoModel();
        $idReserva = $this->request->getPost('id_reserva');
        // Si es cliente, validar que la reserva le pertenece
        if ($session->get('tipo') === 'cliente') {
            $reservaModel = new ReservaModel();
            $reserva = $reservaModel->find($idReserva);
            if (!$reserva || $reserva['id_usuario'] != $session->get('id_usuario')) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No tienes permiso para registrar este pago.');
            }
        } else if ($session->get('tipo') !== 'admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No tienes permiso para acceder a esta sección.');
        }
        $pagoModel->insert([
            'id_reserva'  => $idReserva,
            'monto'       => $this->request->getPost('monto'),
            'metodo_pago' => $this->request->getPost('metodo_pago'),
            'fecha_pago'  => $this->request->getPost('fecha_pago'),
            'estado'      => 'pendiente',
        ]);
        return redirect()->to('/pago');
    }

    public function editar($id)
    {
        $this->soloAdmin();
        $pagoModel = new PagoModel();
        $reservaModel = new ReservaModel();

        $data['pago'] = $pagoModel->find($id);
        $data['reservas'] = $reservaModel->findAll();

        return view('pago/editar', $data);
    }

    public function actualizar($id)
    {
        $this->soloAdmin();
        $pagoModel = new PagoModel();

        $pagoModel->update($id, [
            'id_reserva'  => $this->request->getPost('id_reserva'),
            'monto'       => $this->request->getPost('monto'),
            'metodo_pago' => $this->request->getPost('metodo_pago'),
            'fecha_pago'  => $this->request->getPost('fecha_pago'),
        ]);

        return redirect()->to('/pago');
    }

    public function eliminar($id)
    {
        $this->soloAdmin();
        $pagoModel = new PagoModel();
        $pagoModel->delete($id);

        return redirect()->to('/pago');
    }
}
