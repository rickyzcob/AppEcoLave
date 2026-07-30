<?php

namespace App\Repositories\Client;

use App\Models\UsersVehicles;
use App\Requests\Admin\ClientRequest;
use App\Requests\Client\VehicleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ClientVehiclesRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $userVehiclesDB = UsersVehicles::query()
            ->where('user_id', Auth::id());

            if($orderBy) {
                $userVehiclesDB->orderBy($orderBy['column'], $orderBy['order']);
            }

            if (isset($filterData['search']) && $filterData['search'] != null ) {
                $userVehiclesDB->where('name', 'like', '%'.$filterData['search'].'%');
            }

            if($pageSize) {
                $userVehiclesDB = $userVehiclesDB->paginate($pageSize);
            } else {
                $userVehiclesDB = $userVehiclesDB->get();
            }

            return [
                'status' => 'success',
                'data' => $userVehiclesDB,
                'code' => 200
            ];

        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Indexar'
            ];
        }
    }

    public function create($user_id, $request)
    {
        $vehicleRepository = new VehicleRequest();
        $requestValidated = $vehicleRepository->validate($request);

        try {
            $requestValidated['user_id'] = $user_id;
            $userVehiclesDB = UsersVehicles::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $userVehiclesDB,
                'code' => 200,
                'message' => 'Veículo cadastrado com sucesso !'
            ];

        } catch (Exception $exception){
            return [
                'status' => 'error',
                'data' => $exception,
                'code' => 400,
                'message' => 'Erro ao Cadastrar'
            ];
        }
    }

    public function update($id, $request)
    {
        $vehicleRepository = new ClientRequest();
        $requestValidated = $vehicleRepository->validate($request, $id);

        try {
            DB::beginTransaction();

            $userVehiclesDB = UsersVehicles::query()->findOrFail($id);
            $userVehiclesDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $userVehiclesDB,
                'code' => 200,
                'message' => 'Veículo atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {
            DB::rollback();
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function show($id)
    {
        try {
            $userVehiclesDB = UsersVehicles::query()->find($id);

            return [
                'status' => 'success',
                'data' => $userVehiclesDB,
                'code' => 200,

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];
        }
    }

    public function delete($id = null)
    {
        try {
            DB::beginTransaction();

            $userVehiclesDB = UsersVehicles::query()->findOrFail($id);
            $userVehiclesDB->delete();

            DB::commit();
            return [
                'status' => 'success',
                'data' => $userVehiclesDB,
                'code' => 200,
                'message' => 'Veículo deletado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }
    public function getSelectVehicles($user_id = null)
    {
        $userVehiclesDB = UsersVehicles::query()
            ->where('user_id', $user_id)
            ->orderBy('name', 'ASC');

        $userVehiclesDB = $userVehiclesDB->get();

        $return = [];

        foreach ($userVehiclesDB as $key => $itemUser) {
            $return[$key + 1]['label'] = $itemUser['name']. ' - '. $itemUser['plate'];
            $return[$key + 1]['value'] = $itemUser['id'];
        }

        return $return;
    }

    public function getSelectBrandsVehicles()
    {
        return [
            'Abarth',
            'Acura',
            'Alfa Romeo',
            'Aston Martin',
            'Audi',
            'BAIC',
            'Bentley',
            'BMW',
            'BYD',
            'Cadillac',
            'Caoa Chery',
            'Chevrolet',
            'Chrysler',
            'Citroën',
            'Cupra',
            'Dacia',
            'Daewoo',
            'Daihatsu',
            'Dodge',
            'DS Automobiles',
            'Ferrari',
            'Fiat',
            'Ford',
            'Foton',
            'GAC',
            'Geely',
            'Genesis',
            'GMC',
            'Great Wall Motors',
            'GWM',
            'Hafei',
            'Honda',
            'Hummer',
            'Hyundai',
            'Infiniti',
            'Isuzu',
            'JAC Motors',
            'Jaguar',
            'Jeep',
            'Jinbei',
            'Kia',
            'Lamborghini',
            'Land Rover',
            'Lexus',
            'Lifan',
            'Lincoln',
            'Lotus',
            'Mahindra',
            'Maserati',
            'Mazda',
            'McLaren',
            'Mercedes-Benz',
            'MG',
            'Mini',
            'Mitsubishi',
            'Nissan',
            'Opel',
            'Peugeot',
            'Plymouth',
            'Polestar',
            'Pontiac',
            'Porsche',
            'RAM',
            'Renault',
            'Rolls-Royce',
            'Saab',
            'Seat',
            'Seres',
            'Smart',
            'SsangYong',
            'Subaru',
            'Suzuki',
            'Tesla',
            'Toyota',
            'Volkswagen',
            'Volvo',
        ];

    }

    public function getSelectColorsVehicles()
    {
        return [
            'Amarelo',
            'Azul',
            'Bege',
            'Branco',
            'Bronze',
            'Cinza',
            'Cinza Chumbo',
            'Cinza Grafite',
            'Cobre',
            'Dourado',
            'Laranja',
            'Marrom',
            'Prata',
            'Preto',
            'Rosa',
            'Roxo',
            'Verde',
            'Verde Militar',
            'Vermelho',
            'Vinho',
            'Turquesa',
            'Azul Marinho',
            'Azul Claro',
            'Azul Escuro',
            'Champagne',
            'Pérola',
            'Branco Perolizado',
            'Prata Metálico',
            'Cinza Metálico',
            'Preto Metálico',
            'Vermelho Metálico',
            'Azul Metálico',
            'Verde Metálico',
            'Marrom Metálico',
            'Dourado Metálico',
            'Outra',
        ];

    }

    public function getSelectColorsTypeVehicles()
    {
        return [
            'Conversível',
            'Coupé',
            'Cupê',
            'Crossover',
            'Furgão',
            'Hatch',
            'Hatch Compacto',
            'Hatch Médio',
            'Jipe',
            'Liftback',
            'Limousine',
            'Minivan',
            'Monovolume',
            'Perua',
            'Picape',
            'Picape Compacta',
            'Picape Média',
            'Picape Grande',
            'Roadster',
            'Sedã',
            'Sedã Compacto',
            'Sedã Médio',
            'Sedã Grande',
            'SUV',
            'SUV Compacto',
            'SUV Médio',
            'SUV Grande',
            'SW (Station Wagon)',
            'Utilitário',
            'Van',
            'Micro-ônibus',
            'Ônibus',
            'Caminhão',
            'Caminhonete',
            'Outro',
        ];
    }
}
