<?php

namespace App\Repositories\Admin\Configurations;

use App\Models\Configurations;
use App\Models\User;
use App\Requests\Admin\AdminRequest;
use App\Requests\Admin\ConfigurationsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class ConfigurationsRepository
{

    public function update($request, $logo = null)
    {
        $configurationsRequest = new ConfigurationsRequest();
        $requestValidated = $configurationsRequest->validate($request);

        try {
            DB::beginTransaction();

            $configurationsDB = Configurations::query()->first();

            if(isset($logo) && $logo != $configurationsDB['logo']){
                if(Storage::exists('public/'.$configurationsDB['logo'])) {
                    Storage::delete('public/'.$configurationsDB['logo']);
                }
                $requestValidated['logo'] = $logo->store('configurations/logo', 'public');
            } else {
                $requestValidated['logo'] = $configurationsDB['logo'];
            }

            $configurationsDB->update($requestValidated);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $configurationsDB,
                'code' => 200,
                'message' => 'Configurações atualizada com sucesso !'
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

    public function show($id = null)
    {
        try {
            $configurationsDB = Configurations::query()->first();

            return [
                'status' => 'success',
                'data' => $configurationsDB,
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
}
